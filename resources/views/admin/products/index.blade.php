@extends('layouts.admin_app')
@section('content')
<h2>產品列表</h2>
<span>產品總數: {{ $productCount }}</span>
<div>
    <input type="button" class="import" value="匯入 Excel">
</div>
@if($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    </div>
@endif
<table>
    <thead>
        <tr>
            <th>編號</th>
            <th>標題</th>
            <th>內容</th>
            <th>價格</th>
            <th>數量</th>
            <th>圖片</th>
            <th>功能</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>{{ $product->content }}</td>
            <td>{{ $product->price }}</td>
            <td>{{ $product->quantity }}</td>
            <td><a href="{{ $product->image_url }}">圖片連結</a></td>
            <td>
                <input type="button" class="upload_image" data-id="{{ $product->id }}" value="上傳圖片">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div>
    @for ($i = 1; $i <= $productPages; $i++)
        <a href="/admin/products?page={{ $i }}">第 {{ $i }} 頁</a>
    @endfor
</div>
<script>
    $('.upload_image').on('click', function(){
        $('#product_id').val($(this).data('id'));
        $('#upload-image').modal();
    });
    $('.import').on('click', function(){
        $('#import').modal();
    });
</script>
@endsection
