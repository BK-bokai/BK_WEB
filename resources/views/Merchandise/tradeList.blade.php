@extends('Merchandise.Layouts.master')
@section('title','交易紀錄')
@section('content')
<script src="{{ asset('js/member.js') }}" charset="utf-8"></script>
<style>
    .img_show {
        width: 40px;
        height: 30px;
    }
</style>
<div class="row container containerBody">
    <tr>
        <th>商品資料</th>
        <th>圖片</th>
        <th>單價</th>
        <th>數量</th>
        <th>總金額</th>
        <th>購買時間</th>
    </tr>
    @foreach($TransactionPaginate as $Transaction)
    <tr>
        <td>
            <a href="{{route('Merchandise.Item',['Merchandise'=>$Transaction->Merchandise->id])}}">
                {{ $Transaction->Merchandise->name }}
            </a>
        </td>
        <td>
            <a href="{{route('Merchandise.Item',['Merchandise'=>$Transaction->Merchandise->id])}}">
                <img class="img_show" src="{{ $Transaction->Merchandise->photo  ?? asset('imageMerchandise/default-merchandise.jpg')}}" />
            </a>
        </td>
        <td>{{ $Transaction->price }}</td>
        <td>{{ $Transaction->buy_count }}</td>
        <td>{{ $Transaction->total_price }}</td>
        <td>{{ $Transaction->created_at }}</td>
    </tr>
    @endforeach
    </table>

    {{-- 分頁頁數按鈕 --}}
    {{ $TransactionPaginate->links() }}
</div>

@endsection