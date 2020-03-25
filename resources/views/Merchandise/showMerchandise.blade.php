@extends('Merchandise.Layouts.master')
@section('title','商品頁')
@section('content')
<div class="container">
    <h1>商品頁</h1>
    <p class="teal-text"> {{ session('status') }}
        <p>

            <table class="highlight">
                <tr>
                    <th>名稱</th>
                    <td>{{ $Merchandise->name }}</td>
                <tr>
                <tr>
                    <th>照片</th>
                    <td>
                        <img class="img_show responsive-img" src="{{ $Merchandise->photo ?? asset('imageMerchandise/default-merchandise.jpg')}}" />
                    </td>
                <tr>
                <tr>
                    <th>價格</th>
                    <td>{{ $Merchandise->price }}</td>
                <tr>
                <tr>
                    <th>剩餘數量</th>
                    <td>{{ $Merchandise->remain_count }}</td>
                <tr>
                <tr>
                    <th>介紹</th>
                    <td>{{ $Merchandise->introduction }}</td>
                <tr>
                <tr>
                    <td colspan="2">
                        <form action="{{route('Merchandise.Buy',['Merchandise'=>$Merchandise->id])}}" method="post">
                            購買數量
                            <!-- <select name="buy_count">\
                                @for($count=0;$count<=$Merchandise->remain_count;$count++)
                                    <option value="{{ $count }}">{{ $count }}</option>
                                @endfor
                            </select> -->
                            <div class="input-field col s12">
                                <select name="buy_count">
                                    @for($count=0;$count<=$Merchandise->remain_count;$count++)
                                        <option value="{{ $count }}">{{ $count }}</option>
                                        @endfor
                                </select>
                            </div>
                            <button class="btn waves-effect waves-light" type="submit">購買
                                <i class="material-icons right">send</i>
                            </button>
                            <!-- 自動產生 csrf_token 隱藏欄位-->
                            {!! csrf_field() !!}
                        </form>
                    </td>
                </tr>
            </table>
</div>

@endsection