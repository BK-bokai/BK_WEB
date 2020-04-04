@extends('Merchandise.Layouts.master')
@section('title','商品列表')
@section('merchandiseList', 'orange-text')
@section('content')
<script src="{{ asset('js/member.js') }}" charset="utf-8"></script>
<style>
    .img_show {
        width: 40px;
        height: 30px;
    }
</style>
<div class="row container containerBody">
    <h2>商品列表</h2>
    <table class="highlight">
        <thead>
            <tr>
                <th>名稱</th>
                <th>照片</th>
                <th>價格</th>
                <th>剩餘數量</th>
            </tr>
        </thead>

        <tbody>
            @foreach($MerchandisePaginate as $Merchandise)
            <tr>
                <td>
                    <a href="{{route('Merchandise.Item',['Merchandise'=>$Merchandise->id])}}">
                        {{ $Merchandise->name }}
                    </a>
                </td>
                <td>
                    <a href="{{route('Merchandise.Item',['Merchandise'=>$Merchandise->id])}}">
                        <img class="img_show" src="{{ $Merchandise->photo ?? asset('imageMerchandise/default-merchandise.jpg')}}" />
                    </a>
                </td>
                <td>{{ $Merchandise->price }}</td>
                <td>{{ $Merchandise->remain_count }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{-- 分頁頁數按鈕 --}}
    {{ $MerchandisePaginate->links() }}
</div>

@endsection