<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta name="description" content="GYm,fitness,business,company,agency,multipurpose,modern,bootstrap4">
        
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>{{ config('app.name', 'Laravel BLOG') }}</title>

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
            @include('layouts.partials.footer')
           
         </div>
      </div>

      @include('layouts.partials.footer-scripts')
     
   </body>
</html>