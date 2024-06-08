 <!-- Fonts -->
 <link rel="dns-prefetch" href="//fonts.bunny.net">
 <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

 <!-- Scripts -->
 @vite(['resources/sass/app.scss', 'resources/js/app.js'])


   <!-- bootstrap.min css -->
   
   <link rel="stylesheet" href="{{asset('plugins/bootstrap/css/bootstrap.min.css')}}">
   <!-- Icofont Css -->
   <link rel="stylesheet" href="{{asset('plugins/icofont/icofont.min.css')}}">
   <!-- Themify Css -->
   <link rel="stylesheet" href="{{asset('plugins/themify/css/themify-icons.css')}}">
   <!-- animate.css -->
   <link rel="stylesheet" href="{{asset('plugins/animate-css/animate.css')}}">
   <!-- Magnify Popup -->
   <link rel="stylesheet" href="{{asset('plugins/magnific-popup/dist/magnific-popup.css')}}">
   <!-- Owl Carousel CSS -->
   <link rel="stylesheet" href="{{asset('plugins/slick-carousel/slick/slick.css')}}">
   <link rel="stylesheet" href="{{asset('plugins/slick-carousel/slick/slick-theme.css')}}">
   <!-- Main Stylesheet -->

   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
   
   <link rel="stylesheet" href="{{asset('css/style.css')}}">

 {{-- <link rel="stylesheet" href="{{asset('bootstrap-5.0.2-dist/css/bootstrap.min.css')}}"> --}}

 @stack('styles')

<!-- common_setting_header --> 
@if(isset($g_common_settings) && isset($g_common_settings['header']))
{!! $g_common_settings['header'] !!}
@endif
<!-- common_setting_header  :: END-->

