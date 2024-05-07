<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

      <title>Dashboard - Admin Dashboard</title>
      
      @include('admin.layouts.partials.head')
   </head>
   <body>
      <script src="{{asset('Admin/assets/static/js/initTheme.js')}}"></script>
      <div id="app">
        @include('admin.layouts.partials.sidebar')
         
         <div id="main">
            @include('admin.layouts.partials.nav')
            @include('admin.layouts.partials.header')

            @yield('content')
          
            @include('admin.layouts.partials.footer')
           
         </div>
      </div>

      @include('admin.layouts.partials.footer-scripts')

   </body>
</html>