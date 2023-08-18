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
            <td>
                <input class="check_shared" type="button" name="分享商品" data-id="{{ $item->id }}">
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<script>
    $('.check_shared').on('click', function(){
        var id = $(this).data('id');
        $.ajax({
            method: 'GET',
            url: '/products/' + id + '/shared-url',
        })
        .done(function(msg) {
             alert('縮網址: ' + msg.url);
            
        })
    });
</script>
@endsection
