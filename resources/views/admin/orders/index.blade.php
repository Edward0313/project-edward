@extends('layouts.admin_app')
@section('content')
{{-- @php
    use Illuminate\Support\Facades\DB;
@endphp --}}
{{ DB::enableQueryLog()  }}
<h2>訂單列表</h2>
<span>訂單總數: {{ $orders->count() }}</span>
<div>
    <a href="/admin/orders/excel/export">匯出訂單</a>
    <a href="/admin/orders/excel/export-by-shipped">匯出分類訂單 Excel</a>
</div>
<table>
    <thead>
        <tr>
            <th>購買時間</th>
            <th>購買者</th>
            <th>商品清單</th>
            <th>總金額</th>
            <th>是否運送</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->user->name }}</td>
            <td>
                @foreach ($order->orderItems as $orderItem)
                    {{ $orderItem->product->title }} &nbsp;
                @endforeach
            </td>
            <td>{{ $order->orderItems->sum('price') }}</td>
            <td>{{ $order->is_shipped }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    @for ($i = 1; $i <= $orderPages; $i++)
        <a href="/admin/orders?page={{ $i }}">第 {{ $i }} 頁</a>
    @endfor
</div>
{{-- {{ dd(DB::getQueryLog()) }} --}}
@endsection