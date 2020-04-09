@extends('Merchandise.Layouts.master')
@section('title','商品管理')
@section('merchandiseAdmin', 'orange-text')
@section('content')
<script src="{{ asset('js/merchandise.js') }}" charset="utf-8"></script>
<style>
    .img_show {
        width: 40px;
        height: 30px;
    }
</style>
<div class="row container containerBody">
    <h2>商品管理</h2>
    <table class="highlight centered">
        <thead>
            <tr>
                <th>編號</th>
                <th>名稱</th>
                <th>圖片</th>
                <th>狀態</th>
                <th>價格</th>
                <th>剩餘數量</th>
                <th>操作</th>
            </tr>
        </thead>

        <tbody>
            @foreach($MerchandisePaginate as $Merchandise)
            <tr id = "{{$Merchandise->id}}" >
                <td>{{ $Merchandise->id }}</td>
                <td>{{ $Merchandise->name }}</td>
                <td>
                    <img class="img_show" src="{{ $Merchandise->photo ?? asset('imageMerchandise/default-merchandise.jpg')}}" />
                </td>
                <td>
                    @if($Merchandise->status == 'C')
                    建立中
                    @else
                    可販售
                    @endif
                </td>
                <td>{{ $Merchandise->price }}</td>
                <td>{{ $Merchandise->remain_count }}</td>
                <td>
                    <a href="{{route('Merchandise.Edit',['merchandise'=>$Merchandise->id])}}" class="green-text">
                        編輯
                    </a>
<!-- 
                    <a href="javascript:void(0)" MerId="{{$Merchandise->id}}" url="{{route('Merchandise.Delete',['merchandise'=>$Merchandise->id])}}" class="red-text delMerchandise">
                        刪除
                    </a> -->
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 分頁頁數按鈕 --}}
    {{ $MerchandisePaginate->links() }}
</div>

@endsection