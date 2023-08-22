<?php

namespace App\Exports;

use Illuminate\Support\Facades\Schema;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
{
    $orders = Order::with(['user', 'cart.cartItems.product'])->get();
    $orders = $orders->map(function ($order) {
        return [
            $order->id,
            $order->user->name,
            $order->is_shipped,
            $order->cart->cartItems->sum(function ($cartItem) {
                return $cartItem->product->price * $cartItem->quantity;
            }), // 使用 sum() 方法計算總價
            $order->created_at
        ];
    });
    return $orders;
}
    public function headings(): array
    {
        return Schema::getColumnListing('orders');
    }
}
