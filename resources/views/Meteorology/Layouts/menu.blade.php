@php
$isAdmin=Session::get('isAdmin');
@endphp
<header>
   <div class="menu_box">
      <div id='menu_icon' class="menu_icon">
         <a href="#"><i class="material-icons">menu</i></a>
      </div>
      <div class="logo">
         <a href="{{route('Met.Evaluate')}}">台灣空氣品質模式數據平台</a>
      </div>
      <div class="nav_item">
         <ul>
            <li><a href="{{route('Home.Home')}}">ABC MART</a></li>
            <li><a href="{{route('Met.Evaluate')}}">氣象性能評估系統</a></li>
            <li><a href="{{route('Met.MetData')}}">氣象資料庫管理系統</a></li>
            <li><a href="{{route('Met.logout')}}">登出</a></li>
         </ul>
      </div>
   </div>
   <div id='left_nav' class="left_nav">
      <div>
         <ul>
            <li><a href="{{route('Home.Home')}}">ABC MART</a></li>
            <li><a href="{{route('Met.Evaluate')}}">氣象性能評估系統</a></li>
            <li><a href="{{route('Met.MetData')}}">氣象資料庫管理系統</a></li>
            <li><a href="{{route('Met.logout')}}">登出</a></li>
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