<?php

namespace App\Http\Controllers\Admin;

use App\Exports\OrderMultipleExport;
use App\Exports\OrderExport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderDelivery;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    public function index(Request $request){

        $orderCount = Order::whereHas('orderItems')->count();
        $dataPerPage = 2;
        $orderPages = ceil($orderCount / $dataPerPage);
        $currentPage = isset($request->all()['page']) ? $request->all()['page'] : 1;
        $orders = Order::with(['user','orderItems.product'])->orderBy('created_at', 'desc')
                        ->offset(($currentPage - 1) * $dataPerPage)
                        ->limit($dataPerPage)
                        ->whereHas('orderItems')
                        ->get();

        return view('admin.orders.index', ['orders' => $orders
                                            ,'orderPages' => $orderPages
                                            , 'currentPage' => $currentPage
                                            , 'dataPerPage' => $dataPerPage
                                            , 'orderCount' => $orderCount
                                        ]);
    }

    public function delivery($id){
        $order = Order::find($id);
        if($order->is_shipped){
            return response(['result' => false]);
        }else{
            $order->update(['is_shipped' => true]);
            $order->user->notify(new OrderDelivery);
            return response(['result' => true]);
        }
    }

    public function export()
    {
        return Excel::download(new OrderExport, 'orders.xlsx');
    }

    public function exportByshipped()
    {
        return Excel::download(new OrderMultipleExport, 'orders_by_shipped.xlsx');
    }
}
