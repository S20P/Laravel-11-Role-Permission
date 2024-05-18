

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
              <li class="list-inline-item"><a href="index.html" class="text-sm letter-spacing text-white text-uppercase font-weight-bold">Home</a></li>
              <li class="list-inline-item"><span class="text-white">|</span></li>
              <li class="list-inline-item"><a href="#" class="text-color text-uppercase text-sm letter-spacing">blog single</a></li>
            </ul>
             <h1 class="text-lg text-white mt-2"> {{ $blog->title }}</h1>
        </div>
      </div>
    </div>
  </section>
  
  
  <!-- Section Blog start -->
  <section class="section blog bg-gray">
      <div class="container">
          <div class="row justify-content-center">
              <div class="col-lg-9 col-md-12">
                  <div class="row">
                      <div class="col-lg-12">
      <img src="{{ asset('uploads/blogs/'.$blog->image) }}" alt="" class="img-fluid">
      <div> {!! $blog->body !!} </div>
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
  
      <div class="mt-4 border-bottom pb-5">
          <ul class="list-group list-group-horizontal justify-content-center">
            <li class="list-group-item rounded-0 "><a href="#" class="text-black"><i class="ti-angle-left mr-3"></i>Previous</a></li>
            <li class="list-group-item rounded-0"><a href="#" class="text-black">Next <i class="ti-angle-right ml-3"></i></a></li>
          </ul>
      </div>
  
      <div class="mt-5 border-bottom pb-5">
          <h4 class="mb-2 font-secondary text-uppercase font-weight-normal mb-4">comments</h4>
          <div class="media">
            <img src="images/blog/post-1.jpg" class="mr-4 img-fluid" alt="...">
            <div class="media-body">
              <h4 class="mt-0 mb-0">Zander Rohan</h4>
              <span>15 january 2019 At 10:30 pm</span>
              <p class="mt-2">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
  
              <span><a href="#" class="btn reply-btn">Reply</a></span>
  
              <div class="media mt-5">
                <a class="mr-3" href="#">
                   <img src="images/blog/post-2.jpg" class="mr-4 img-fluid" alt="...">
                </a>
                <div class="media-body">
                 <h4 class="mt-0 mb-0">Moris hnery</h4>
                  <span>15 january 2019 At 10:30 pm</span>
                  <p class="mt-2">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
  
                  <span><a href="#" class="btn reply-btn">Reply</a></span>
                </div>
              </div>
            </div>
          </div>
  
          <div class="media mt-5">
            <img src="images/blog/post-1.jpg" class="mr-4 img-fluid" alt="...">
            <div class="media-body">
              <h4 class="mt-0 mb-0">Gyle hank</h4>
              <span>15 january 2019 At 10:30 pm</span>
              <p class="mt-2">Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis.</p>
  
              <span><a href="#" class="btn reply-btn">Reply</a></span>
            </div>
          </div>
      </div>
  
  
      <div class="mt-4 py-4 text-center comments">
          <h4 class="mb-2 font-secondary text-uppercase font-weight-normal">Leave a reaply</h4>
          <p class="mb-5">Your email address will not be published.</p>
  
          <form action="#" class="text-left">
              <div class="form-row">
                  <div class="col ">
                      <div class="form-group">
                          <input type="text" name="name" class="form-control" placeholder="Your name">
                      </div>
                  </div>
                  <div class="col">
                      <div class="form-group">
                          <input type="text" name="email" class="form-control" placeholder="Your email">
                      </div>
                  </div>
              </div>
              
              <div class="form-group text-center">
                  <textarea name="msg" id="msg" cols="30" rows="6" class="form-control" placeholder="Your Comment"></textarea>
  
                  <div class="form-check mt-3">
                    <input class="form-check-input" type="checkbox" id="gridCheck">
                    <label class="form-check-label" for="gridCheck">
                      Save my name, email, and website in this browser for the next time I comment.
                    </label>
                  </div>
  
                  <a href="#" class="btn btn-main mt-4">Add Comment</a>
              </div>
          </form>
      </div>
  </div>
  
  
  
  
                  </div>
              </div>
              <div class="col-lg-3 col-md-8">
                  <div class="card border-0 rounded-0 mb-5">
      <form action="#" class="search position-relative">
          <input type="text" placeholder="Search" class="form-control">
          <i class="ti-search"></i>
      </form>
  </div>
  
  <div class="mb-5 follow">
      <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Follow us</h5>
  
      <a href="#" class="text-muted"><i class="ti-facebook"></i></a>
      <a href="#" class="text-muted"><i class="ti-twitter"></i></a>
      <a href="#" class="text-muted"><i class="ti-linkedin"></i></a>
      <a href="#" class="text-muted"><i class="ti-pinterest"></i></a>
      <a href="#" class="text-muted"><i class="ti-dribbble"></i></a>
  </div>
  
  
  <div class="mb-5">
      <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Popular posts</h5>
  
      <div class="media mb-4">
        <img src="images/blog/blog-post-5.jpg" alt="" class="img-fluid pr-4 w-50 align-self-center">
        <div class="media-body">
          <a href="#" class="text-black d-block lh-25"> Track your daily body fitness</a>
        </div>
      </div>
  
      <div class="media mb-4">
        <img src="images/blog/blog-post-6.jpg" alt="" class="img-fluid pr-4 w-50 align-self-center">
        <div class="media-body">
          <a href="#" class="text-black d-block lh-25">Keep your body fitness track</a>
        </div>
      </div>
  
      <div class="media mb-4">
        <img src="images/blog/post1.jpg" alt="" class="img-fluid pr-4 w-50 align-self-center">
        <div class="media-body">
          <a href="#" class="text-black d-block lh-25">Keep your body fitness track</a>
        </div>
      </div>
  </div>
  
  
  <div class="mb-5 categories">
      <h5 class="font-secondary mb-4"><i class="ti-minus mr-2 text-color"></i>Categories</h5>
      
      <ul class="list-group">
        @foreach ($blog->categories as $category)
         <li class="list-group-item d-flex justify-content-between align-items-center rounded-0 border-0">
          <a href="#" class="text-muted">{{ $category->name }}</a>
         <span class="badge bg-primary badge-pill text-white border-0">14</span>
       </li>
        @endforeach        
      </ul>
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
  @endsection