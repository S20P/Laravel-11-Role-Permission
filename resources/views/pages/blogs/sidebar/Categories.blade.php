<ul class="list-group">
    @foreach ($categories as $category)
     <li class="list-group-item d-flex justify-content-between align-items-center rounded-0 border-0">
      <a href="{{route('blog.show.category',$category->slug)}}" class="text-muted">{{ $category->name }}</a>
     <span class="badge bg-primary badge-pill text-white border-0">14</span>
   </li>
    @endforeach        
  </ul>