<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Jobs\UpdateProductPrice;

class ToolController extends Controller
{
    public function updateProductPrice()
    {
        $products = Product::all();
        foreach($products as $product){
            //Queue job to update product price
            UpdateProductPrice::dispatch($product)->onQueue('tool');
        }
    }

    public function createProductRedis(){
        Redis::set('products', json_encode(Product::all()));
    }
}
