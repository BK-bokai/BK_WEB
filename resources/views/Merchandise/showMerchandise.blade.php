@extends('Merchandise.Layouts.master')
@section('title','商品頁')
@section('merchandiseList', 'orange-text')
@section('content')
<div class="container">
    <h1>商品頁</h1>
    <p class="teal-text"> {{ session('status') }}</p>
    <table class="highlight">
        <tr>
            <th>名稱</th>
            <td class='name'>{{ $Merchandise->name }}</td>
        <tr>
        <tr>
            <th>照片</th>
            <td>
                <img class="img_show responsive-img" src="{{ $Merchandise->photo ?? asset('imageMerchandise/default-merchandise.jpg')}}" />
            </td>
        <tr>
        <tr>
            <th>價格</th>
            <td class="price">{{ $Merchandise->price }}</td>
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
                        <select name="buyCount" class="buyCount">
                            @for($count=0;$count<=$Merchandise->remain_count;$count++)
                                <option value="{{ $count }}">{{ $count }}</option>
                                @endfor
                        </select>
                    </div>

                    @error('buyCount')
                    <p class="red-text">{{ $message }}</p>
                    @enderror
                    <button class="btn waves-effect waves-light butBtn" type="submit">購買
                        <i class="material-icons right">send</i>
                    </button>
                    <!-- 自動產生 csrf_token 隱藏欄位-->
                    {!! csrf_field() !!}
                </form>
            </td>
        </tr>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('.butBtn').on('click', function(e) {
            e.preventDefault();
            let name = $('.name').text();
            let price = $('.price').text();
            let buyCount = $('.buyCount').val();
            let totalPrice = price * buyCount
            let img = $('.img_show').attr('src');
            Swal.fire({
                title: name,
                text: `購買數量：${buyCount}，總金額：${totalPrice}`,
                // icon: 'warning',
                imageUrl: img,
                imageWidth: 400,
                imageHeight: 200,
                showCancelButton: true,
                cancelButtonText: '取消！',
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: '確認購買'
            }).then((result) => {
                if (result.value) {
                    $('form').submit();
                    Swal.fire(
                        '購買完成!',
                        '系統將自動轉跳至購買紀錄',
                        'success'
                    )
                }
            })
        })
    })
</script>

@endsection