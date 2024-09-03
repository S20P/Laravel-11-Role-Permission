<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="GYm,fitness,business,company,agency,multipurpose,modern,bootstrap4">
        
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7456798836103342"
     crossorigin="anonymous"></script>

      @php
      $meta_title = "";
      $meta_description = "";
      $tagline = "";
      $site_icon = "";
      if(isset($g_common_settings)){
         if(isset($g_common_settings['site_title'])){
           $meta_title =  $g_common_settings['site_title'];
         }
         if(isset($g_common_settings['site_description'])){
           $meta_description =  $g_common_settings['site_description'];
         }
         if(isset($g_common_settings['tagline'])){
           $tagline =  $g_common_settings['tagline'];
         }
         if(isset($g_common_settings['site_icon'])){
           $site_icon = asset('uploads/'.$g_common_settings['site_icon']);
         }
      }  
      
      
  
      @endphp

      <title>@yield('meta_title',$meta_title) {{$tagline}}</title>
      <link rel="shortcut icon" href="{{$site_icon}}" type="image/x-icon">

      @include('layouts.partials.meta-tags')
      
      @include('layouts.partials.head')
   </head>
   <body>
      <div id="app">
         <div class="main-wrapper">      
            @include('layouts.partials.header')

            <div id="main-content">
                 @yield('content')
            </div>

            @stack('ad_before_footer')
            @include('layouts.partials.footer')
            @stack('ad_after_footer')
           
         </div>
      </div>

      @include('layouts.partials.footer-scripts')
     
   </body>
</html>