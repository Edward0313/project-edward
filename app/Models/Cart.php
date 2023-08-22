<?php

namespace App\Models;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = [''];
    protected $fillable = ['user_id', 'checkouted','quantity'];
    protected $rate = 1;

    public function cartItems()
{
    return $this->hasMany(CartItem::class);
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }



    public function checkout()
    {
        DB::beginTransaction();
            try{
                //檢查商品數量
                foreach($this->cartItems as $cartItem){
                    $product = $cartItem->product;
                    if(!$product->checkQuantity($cartItem->quantity)){
                        return $product->title.'數量不足';
                    }
                }


                //建立訂單
                $order = $this->order()->create([
                    'user_id' => $this->user_id,

                ]);
                //vip打折
                if($this->user->level == 2){
                    $this->rate = 0.8;
                }


                //建立訂單項目
                foreach($this->cartItems as $cartItem){
                    $order->orderItems()->create([
                        'product_id' => $cartItem->product_id,
                        'price' => $cartItem->product->price  * $this->rate
                    ]);
                    $cartItem->product->update([
                        'quantity' => $cartItem->product->quantity - $cartItem->quantity
                    ]);
                }

                $this->update(['checkouted' => true]);
                $order->orderItems;
                DB::commit();
                return $order;
            }catch(\Throwable $e){
                DB::rollBack();
                return 'error';
            }




    }

}
