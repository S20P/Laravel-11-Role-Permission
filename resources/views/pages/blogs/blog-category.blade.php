
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

  @include("pages.ad-inserter.block",['pageTypeParam' => "category_page", "position"=>'before_post'])
  <!-- Section Blog start -->
  <section class="section blog bg-gray">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="section-title">
          <div class="divider mb-3"></div>
          <h2>{{$mainCategory->name??''}}</h2>
          <p class="mt-3">{{$mainCategory->description??''}}</p>
        </div>
      </div>
    </div>
      <div class="container">
        <div id="blog_table_data">
            @include("pages.blogs.blog-items")
        </div>          
      </div>
  </section>
  <!-- Section Blog End -->
  @include("pages.ad-inserter.block",['pageTypeParam' => "category_page", "position"=>'after_post'])
  @push('ad_before_footer')
  @include("pages.ad-inserter.block",['pageTypeParam' =>"category_page", "position"=>'before_footer'])
  @endpush
  @push('ad_after_footer')
  @include("pages.ad-inserter.block",['pageTypeParam' =>"category_page", "position"=>'after_footer'])
  @endpush
<input type="hidden" value="{{ route('blog.ajax') }}" id="blog_ajax_url">
@endsection
@push('scripts')
    <script src="{{ asset('js/blog.js') }}"></script>
@endpush

