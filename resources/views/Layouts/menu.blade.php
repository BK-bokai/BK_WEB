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
         <a href="{{route('Home.Home')}}">BK WEB</a>
      </div>
      <div class="nav_item">
         <ul>
            <li><a href="{{route('Home.Home')}}" class="@yield('home')">個人簡介</a></li>
            @if($isLogin)
            @if($isAdmin)
            <li><a href="{{route('Home.Admin')}}" class="@yield('homeAdmin')">編輯個人簡介</a></li>
            @endif
            <li><a href="{{route('Chat.index')}}" class="@yield('chat')">聊天區</a></li>
            @if($isAdmin)
            <li><a href="{{route('Member.List')}}" class="@yield('memberAdmin')">會員管理</a></li>
            @endif
            <li><a href="{{route('Member.UpdatePwdPage',['member'=>$user->id])}}" class="@yield('PwChange')">修改密碼</a></li>
            <li><a href="{{route('Met.logout')}}">登出</a></li>
            @else
            <li><a href="{{route('login')}}" class="@yield('login')">會員登入</a></li>
            <li><a href="{{route('register')}}" class="@yield('register')">會員註冊</a></li>
            @endif
         </ul>
      </div>
   </div>
   <div id='left_nav' class="left_nav">
      <div>
         <ul>
            <li><a href="{{route('Home.Home')}}" class="@yield('home')">個人簡介</a></li>
            @if($isLogin)
            @if($isAdmin)
            <li><a href="{{route('Home.Admin')}}" class="@yield('homeAdmin')">編輯個人簡介</a></li>
            @endif
            <li><a href="{{route('Chat.index')}}" class="@yield('chat')">聊天區</a></li>
            @if($isAdmin)
            <li><a href="{{route('Member.List')}}" class="@yield('memberAdmin')">會員管理</a></li>
            @endif
            <li><a href="{{route('Member.UpdatePwdPage',['member'=>$user->id])}}" class="@yield('PwChange')">修改密碼</a></li>
            <li><a href="{{route('Met.logout')}}">登出</a></li>
            @else
            <li><a href="{{route('login')}}" class="@yield('login')">會員登入</a></li>
            <li><a href="{{route('register')}}" class="@yield('register')">會員註冊</a></li>
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