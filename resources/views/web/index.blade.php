@extends('layouts.app')
@section('content')
<h2>商品列表</h2>
<img src="" alt="">
<table>
    <thead>
        <tr>
            <td>標題</td>
            <td>內容</td>
            <td>價格</td>
            <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $item)
        <tr>
            <td>{{ $item->title }}</td>
            <td>{{ $item->content }}</td>
            <td>{{ $item->price }}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
