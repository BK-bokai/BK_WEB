@php
$isAdmin=Session::get('isAdmin');
$isLogin=Session::get('isLogin');
@endphp
<header>
   <div class="menu_box">
      <div id='menu_icon' class="menu_icon">
         <a href="#"><i class="material-icons">menu</i></a>
      </div>
      <div class="logo">
         <a href="{{route('Home.Home')}}">ABC MART</a>
      </div>
      <div class="nav_item">
         <ul>
            <li><a href="{{route('Home.Home')}}">個人簡介</a></li>
            <li><a href="{{route('Merchandise.Home')}}">商品列表</a></li>
            @if(!$isLogin)
            <li><a href="{{route('login')}}">會員登入</a></li>
            <li><a href="{{route('register')}}">會員註冊</a></li>
            @else
            <li><a href="{{route('Met.Evaluate')}}">台灣空氣品質模式數據平台</a></li>
            <li><a href="{{route('Chat.index')}}">聊天區</a></li>
            @if($isAdmin)
            <li><a href="{{route('Home.Admin')}}">編輯個人簡介</a></li>
            <li><a href="{{route('Member.List')}}">會員管理</a></li>
            @endif
            <li><a href="{{route('Member.UpdatePwdPage',['member'=>$user->id])}}">修改密碼</a></li>
            <li><a href="{{route('Met.logout')}}">登出</a></li>
            @endif
         </ul>
      </div>
   </div>
   <div id='left_nav' class="left_nav">
      <div>
         <ul>
            <li><a href="{{route('Home.Home')}}">個人簡介</a></li>
            <li><a href="{{route('Merchandise.Home')}}">商品列表</a></li>
            @if(!$isLogin)
            <li><a href="{{route('login')}}">會員登入</a></li>
            <li><a href="{{route('register')}}">會員註冊</a></li>
            @else
            <li><a href="{{route('Met.Evaluate')}}">台灣空氣品質模式數據平台</a></li>
            @if($isAdmin)
            <li><a href="{{route('Home.Admin')}}">編輯個人簡介</a></li>
            <li><a href="{{route('Member.List')}}">會員管理</a></li>
            @endif
            <li><a href="{{route('Member.UpdatePwdPage',['member'=>$user->id])}}">修改密碼</a></li>
            <li><a href="{{route('Met.logout')}}">登出</a></li>
            @endif
         </ul>
      </div>
   </div>

   <script>
      $(document).ready(function() {
         $('.sidenav').sidenav();

         $('body').on('touchend click', function(e) {
            // e.stopPropagation();
            // e.preventDefault();
            if (e.target.id == 'left_nav' || $(e.target).parents("#left_nav").length == 1 || e.target.id == 'menu_icon' || $(e.target).parents("#menu_icon").length == 1) {

               setTimeout(function() {
                  $('.left_nav').show();
               }, 100)
            } else {
               $('.left_nav').hide();
            }
         });

         $('header li').on('click', function(e) {
            // e.stopPropagation();
            let url = $(this).children().attr('href');
            location.href = url;
         })
      });
   </script>
</header>