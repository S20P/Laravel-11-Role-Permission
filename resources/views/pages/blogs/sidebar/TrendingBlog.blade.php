
@foreach ($trendingBlogs as $blog)
  <div class="media mb-4">
    <img src="{{ asset('uploads/blogs/'.$blog->image) }}" alt="" class="img-fluid pr-4 w-50 align-self-center">
    <div class="media-body">
      <a href="{{ route('blog.show',["slug"=>$blog->slug]) }}" class="text-black d-block lh-25">{{$blog->title}}</a>
    </div>
  </div>
 @endforeach
