
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
    
  @if ($errors->any())
  <div class="alert alert-danger">
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
  </div>
 @endif
 @include("pages.ad-inserter.block",['pageTypeParam' => "search_page", "position"=>'before_post'])
  <!-- Section Blog start -->
  <section class="section blog bg-gray">
      <div class="container">

        <div class="card border-0 rounded-0 mb-5">
          <form action="#" class="search position-relative">
              <input type="text" id="blogSearch" placeholder="Search" class="form-control">
              <i class="ti-search"></i>
          </form>
       </div>

        <div id="blog_table_data">
            @include("pages.blogs.blog-items")
        </div>          
      </div>
  </section>
  <!-- Section Blog End -->
  @include("pages.ad-inserter.block",['pageTypeParam' => "search_page", "position"=>'after_post'])
  @push('ad_before_footer')
  @include("pages.ad-inserter.block",['pageTypeParam' =>"search_page", "position"=>'before_footer'])
  @endpush
  @push('ad_after_footer')
  @include("pages.ad-inserter.block",['pageTypeParam' =>"search_page", "position"=>'after_footer'])
  @endpush

<input type="hidden" value="{{ route('blog.ajax') }}" id="blog_ajax_url">
@endsection
@push('scripts')
    <script src="{{ asset('js/blog.js') }}"></script>
@endpush

