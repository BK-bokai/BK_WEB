@extends('Layouts.master')
@section('title','會員管理')
@section('memberAdmin', 'orange-text')
@section('content')

<script src="{{ asset('js/member.js') }}" charset="utf-8"></script>

<div class="row container containerBody">
    <div class="col s12 memberList">
        <table class="highlight centered responsive-table striped">
            <thead>
                <tr>
                    <th>id</th>
                    <th>帳號 </th>
                    <th>信箱</th>
                    <th>active </th>
                    <th>admin</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($members as $member)
                <tr id="{{ $member['id'] }}">
                    <td>{{ $member->id }}</td>
                    <td>{{ $member->name }}</td>
                    <td>{{ $member->email }}</td>
                    <td>{{ $member->active }}</td>
                    <td>
                        @if($member->admin)
                        <i class="fas fa-check-circle"></i>
                        @else
                        <i class="fas fa-times-circle"></i></i>
                        @endif
                    </td>
                    <td>
                        <a userId="{{$member->id}}" class="red-text delMem" href="javascript:void(0)" url="{{route('Member.Delete',['member'=>$member->id])}}">刪除</a>
                        <a class="green-text delEva memberPage" href="javascript:void(0)" url="{{route('Member.memberPage',['member'=>$member->id])}}">編輯</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{route('Member.AddPage')}}" class="btn tooltipped btn-floating btn-large waves-effect waves-light black pulse" data-position="right" data-tooltip="新增會員" style="margin-top: 5px;">
            <i class="material-icons">add</i>
        </a>
    </div>
</div>

@endsection