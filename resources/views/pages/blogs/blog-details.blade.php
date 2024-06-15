

@extends('layouts.app')

@if($meta_info && count($meta_info) > 0)    
  @foreach($meta_info as $meta)
      @switch($meta['meta_key'])
          @case("title")
              @section('meta_title', $meta['meta_value'])
          @break
          @case("description")
              @section('meta_description', $meta['meta_value'])
          @break
          @case("keywords")
               @section('meta_keywords', $meta['meta_value'])  
          @break
          @case("author")
               @section('meta_author', $meta['meta_value'])
          @break
          @case("og_type")
               @section('meta_og_type', $meta['meta_value'])
          @break
          @case("og_title")
               @section('meta_og_title', $meta['meta_value'])
          @break
          @case("og_description")
                @section('meta_og_description', $meta['meta_value'])
          @break
          @case("og_image")
               @php
                    $meta_image = asset('uploads/blogs/'.$meta['meta_value']);
               @endphp
               @section('meta_og_image', $meta_image)
          @break
          @default              
      @endswitch
  @endforeach  
@endif

@section('content')
<section class="page-title bg-2">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
            <ul class="list-inline mb-0">
              <li class="list-inline-item"><a href="{{url('/')}}" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
              <li class="list-inline-item"><span class="text-white">|</span></li>
              <li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">blog single</a></li>
            </ul>          
             <h1 class="text-lg text-white mt-2"> {{ $blog->title }}</h1>
        </div>
      </div>
    </div>
  </section>



  @include("pages.ad-inserter.block",['pageTypeParam' => "post", "position"=>'before_post'])
  
  <!-- Section Blog start -->
  <section class="section blog bg-gray">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-9 col-md-12">
                  <div class="row">
                      <div class="col-lg-12">
        @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'before_image'])
          <img src="{{ asset('uploads/blogs/'.$blog->image) }}" alt="" class="img-fluid">
      @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'after_image'])


      <h2>Table of Contents</h2>
      <div id="toc-container">
          <ul id="toc"></ul>
      </div>
      
      <div id="blog-content"> {!! $blog->body !!} </div>
{{--   
      <blockquote class="blockquote p-4 bg-white text-black font-italic my-5">
          <i class="ti-quote-left text-lg text-color mr-2"></i>Merupakan fakta bahwa seorang pembaca akan terpengaruh oleh isitue tulisan dari sebuah halaman saat ia melihat tata letaknya. Maksud penggunaan Lorem Ipsum adalah karena ia kurang lebih memiliki penyebaran huruf.
      </blockquote>
  
      <div class="media mb-4">
          <img src="images/blog/blog-post-5.jpg" alt="" class="img-fluid mr-4">
          <div class="media-body">
              <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Aliquam quam elit, mollis at odio gravida, ultrices pulvinar justo. Vivamus eleifend mollis dolor, et ornare turpis vehicula in. Pellentesque auctor ac enim sit amet euismod. Ut eu accumsan nunc. Nam ultrices, orci a volutpat molestie, ipsum magna posuere ex, vel lobortis dolor purus tristique purus.</p>
          </div>
      </div>
      <p>Aliquam lobortis efficitur velit, vel tempor dui iaculis non. Mauris non ullamcorper leo. Nulla consectetur arcu eget condimentum auctor. Aliquam sagittis dictum augue. Duis fringilla nec augue eu laore</p>
   --}}
      <div class="post-tags my-5 text-uppercase font-size-12 letter-spacing text-center">
        <a href="#" class="mr-2 text-black"><i class="ti-bookmark mr-2 text-color"></i>Yoga </a>
        <a href="#" class="mr-2 text-black"><i class="ti-bookmark mr-2 text-color"></i>Meditation</a>
        <a href="#" class="mr-2 text-black"><i class="ti-bookmark mr-2 text-color"></i>Nutirtion</a>
        <a href="#" class="mr-2 text-black"><i class="ti-bookmark mr-2 text-color"></i>Healthy diet</a>
      </div>
  
  
      <div class="border-top border-bottom py-4 text-center social-share">
          <h4 class="mb-4 font-secondary text-uppercase font-weight-normal">Like the post?</h4>
          <ul class="list-inline mb-0">
              <li class="list-inline-item"><a href="#"><i class="ti-facebook"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-twitter"></i></a></li>
              <li class="list-inline-item"><a href="#"><i class="ti-linkedin"></i></a></li>
          </ul>
      </div>
  
      <div class="mt-4 py-4 text-center social-share">
          <h4 class="mb-5 font-secondary text-uppercase font-weight-normal">More similar posts</h4>
          <div class="row">
              <div class="col-lg-4 col-md-6">
      <article class="card border-0 rounded-0 mb-4">
          <img src="images/blog/post1.jpg" alt="" class="img-fluid">
  
          <div class="mt-3 px-4 py-3">
              <span class="post-meta author text-capitalize text-sm"><i class="ti-user mr-2 text-muted"></i>john stain</span>
              <a href="blog-single.html"><h5 class="font-secondary mt-2">Make your fitness Boost with us</h5></a>
          </div>
      </article>
  </div>
  
  <div class="col-lg-4 col-md-6">
      <article class="card border-0 rounded-0 mb-4">
          <img src="images/blog/post2.jpg" alt="" class="img-fluid">
  
          <div class="mt-3 px-4 py-3">
              <span class="post-meta author text-capitalize text-sm"><i class="ti-user mr-2 text-muted"></i>john stain</span>
              <a href="blog-single.html"><h5 class="mt-2 font-secondary">Ethernity beauty health diet plan</h5></a>
          </div>
      </article>
  </div>
  
  <div class="col-lg-4 col-md-6">
      <article class="card border-0 rounded-0">
          <img src="images/blog/post3.jpg" alt="" class="img-fluid">
  
          <div class="mt-3 px-4 py-3">
              <span class="post-meta author text-capitalize text-sm"><i class="ti-user mr-2 text-muted"></i>john stain</span>
              <a href="blog-single.html"><h5 class="mt-2 font-secondary">Ever too late to lose weight?</h5></a>
          </div>
      </article>
  </div>
  
          </div>
      </div>
  
      {{-- <div class="mt-4 border-bottom pb-5">
          <ul class="list-group list-group-horizontal justify-content-center">
            <li class="list-group-item rounded-0 "><a href="#" class="text-black"><i class="ti-angle-left mr-3"></i>Previous</a></li>
            <li class="list-group-item rounded-0"><a href="#" class="text-black">Next <i class="ti-angle-right ml-3"></i></a></li>
          </ul>
      </div> --}}

      @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'before_comments'])

      @if(isset($blog->comments) && count($blog->comments) > 0)  
      <div class="mt-5 border-bottom pb-5">
      <h4 class="mb-2 font-secondary text-uppercase font-weight-normal mb-4">comments</h4>
           @include("pages.blogs.commentsDisplay",['comments' => $blog->comments, 'blog_id' => $blog->id])
      </div>
      @endif
      
      @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'between_comments'])

      @if ($message = Session::get('success'))
            <div class="alert alert-success text-center" role="alert">
                {{ $message }}
            </div>
      @endif

     

      <div class="mt-4 py-4 text-center comments">
          <h4 class="mb-2 font-secondary text-uppercase font-weight-normal">Leave a reaply</h4>
          <p class="mb-5">Your email address will not be published.</p>
  
          <form method="post" action="{{ route('comments.store') }}" id="commentFrom" class="text-left">
             @csrf
              <input type="hidden" name="blog_id" value="{{ $blog->id }}" />
               <div class="form-row">
                  <div class="col">
                      <div class="form-group">
                          <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Your name">
                          @if ($errors->has('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                          @endif
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <input type="text" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Your email">
                          @if ($errors->has('email'))
                          <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                      </div>
                  </div>
              </div>
              
              <div class="form-group text-center">
                  <textarea name="comment" id="comment" cols="30" rows="6" class="form-control @error('comment') is-invalid @enderror" placeholder="Your Comment"></textarea>
                  @if ($errors->has('comment'))
                  <span class="text-danger">{{ $errors->first('comment') }}</span>
                  @endif
{{--   
                  <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Save my name, email, and website in this browser for the next time I comment.
                    </label>
                  </div>   --}}
                  <button type="submit" class="btn btn-main mt-4">Add Comment</button> 
              </div>
          </form>
      </div>

      @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'after_comments'])

  </div>
 
  
                  </div>
              </div>
 <div class="col-lg-3 col-md-8">
    {{-- <div class="card border-0 rounded-0 mb-5">
        <form action="#" class="search position-relative">
            <input type="text" placeholder="Search" class="form-control">
            <i class="ti-search"></i>
        </form>
    </div> --}}
  
  {{-- <div class="mb-5 follow">
      <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Follow us</h5>
      <a href="#" class="text-muted"><i class="ti-facebook"></i></a>
      <a href="#" class="text-muted"><i class="ti-twitter"></i></a>
      <a href="#" class="text-muted"><i class="ti-linkedin"></i></a>
      <a href="#" class="text-muted"><i class="ti-pinterest"></i></a>
      <a href="#" class="text-muted"><i class="ti-dribbble"></i></a>
  </div> --}}

  @if(isset($g_common_settings) && isset($g_common_settings['social_media_enabled']) && $g_common_settings['social_media_enabled']=="active")
  @include("pages.blogs.sidebar.SocialMediaLinks")
  @endif

  <div class="mb-5">
      <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Related blogs</h5>
      @include("pages.blogs.sidebar.RelatedBlog",['relatedBlogs' => $relatedBlogs])
  </div>

  <div class="mb-5">
    <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Top Trending blogs</h5>
    @include("pages.blogs.sidebar.TrendingBlog",['trendingBlogs' => $trendingBlogs])
  </div>
    
  <div class="mb-5 categories">
      <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Categories</h5>
      @include("pages.blogs.sidebar.Categories",['categories' => $categories])
  </div>

  <div class="mb-5">
    @include("pages.blogs.sidebar.Block")    
  </div>
  
                <div class="mb-5 tags">
                    <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Tags</h5>
                    <a href="#">body</a>
                    <a href="#">fitness</a>
                    <a href="#">health</a>
                    <a href="#">diet</a>
                    <a href="#">plan</a>
                    <a href="#">gym</a>
                    <a href="#">trainer</a>
                    <a href="#">tutorials</a>
                </div>
  
              </div>
          </div>
      </div>
  </section>

 <!-- Dynamic Block setting section -->
  @if($setting_info && count($setting_info) > 0)   
     @php
          $block_setting = $setting_info->where('key',"block")->first();
     @endphp
     @if($block_setting)
            {!! $block_setting['value'] !!}
     @endif
  @endif

  @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'after_post'])
        @push('ad_before_footer')
        @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'before_footer'])
        @endpush
        @push('ad_after_footer')
        @include("pages.ad-inserter.block",['pageTypeParam' =>"post", "position"=>'after_footer'])
        @endpush
        
  @endsection
  <!-- Dynamic Block setting section :: END -->


  @push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="{{ asset('js/blog.js') }}"></script>
  @endpush