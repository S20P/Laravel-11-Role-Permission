
@extends('layouts.app')
@section('content')
{{-- <div class="container"> --}}
                {{-- <div id="blog_table_data">
                         @include("pages.blogs.blog-items")
                </div> --}}
{{-- </div> --}}
<section class="page-title bg-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
              <li class="list-inline-item"><span class="text-white">|</span></li>
              <li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">our blog</a></li>
            </ul>
             <h1 class="text-lg text-white mt-2">blog article</h1>
        </div>
      </div>
    </div>
  </section>
  
  <!-- Section Blog start -->
  <section class="section blog bg-gray">
      <div class="container">
        <div id="blog_table_data">
            @include("pages.blogs.blog-items")
        </div>          
      </div>
  </section>
  <!-- Section Blog End -->
  
<input type="hidden" value="{{ route('blog.ajax') }}" id="blog_ajax_url">
@endsection
@push('scripts')
    <script src="{{ asset('js/blog.js') }}"></script>
@endpush

