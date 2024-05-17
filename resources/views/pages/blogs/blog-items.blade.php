<div class="row">              
  @forelse ($blogs as $blog)
  <div class="col-lg-4 col-md-6">
      <article class="card border-0 rounded-0 mb-4">
          <img src="{{ asset('uploads/blogs/'.$blog->image) }}"  width="400px" height="480px" alt="" class="img-fluid">
          <div class="mt-3 px-4 py-3">
              <div class="blog-post-meta text-capitalize mb-2">
                  <span class="post-meta date-meta mr-2">
                  <i class="ti-calendar mr-2"></i>{{ date('Y-m-d', strtotime($blog->published_at)) }}</span> 
  
                  <span class="post-meta author"><i class="ti-user mr-2 text-muted"></i>{{ $blog->author_name }}</span>
              </div>
              <a href="{{ route('blog.show',["slug"=>$blog->slug]) }}"><h4 class="mb-3 font-secondary">{{$blog->title}}</h4></a>
                  
              <p class="mb-4">{{ $blog->short_description }}</p>
  
              <a href="{{ route('blog.show',["slug"=>$blog->slug]) }}" class="text-color mb-3 d-block"><i class="ti-minus mr-2"></i> Read More</a>
          </div>
      </article>
  </div>
  @empty
  <p colspan="9">
    <span class="text-danger">
        <strong>No Blogs Found!</strong>
    </span>
</p>
  @endforelse
</div>
{{ $blogs->links() }}