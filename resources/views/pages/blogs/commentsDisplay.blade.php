
@if($comments && count($comments) > 0)   
  @foreach($comments as $comment)
    <div class="media mt-5" @if($comment->parent_id != null) style="margin-left:40px;" @endif>
      <img src="{{asset('images/blog/post-1.jpg')}}" class="mr-4 img-fluid" alt="...">
      <div class="media-body">
        <h4 class="mt-0 mb-0">{{ $comment->name }}</h4>
        <span>{{ $comment->created_at->format('d M Y, H:i') }}</span>
        <p class="mt-2">{{ $comment->comment }}</p>

        <span><a href="#" class="btn reply-btn" data-id="{{$comment->id}}">Reply</a></span>

         <form method="post" action="{{ route('comments.store') }}" class="text-left replayForm" id="{{'replayForm'.$comment->id}}" style="display:none">
          @csrf
          <div class="form-group">     
            <input type="hidden" name="blog_id" value="{{ $blog_id }}" />
            <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
           </div>
          
            <div class="form-row">
               <div class="col">
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
               <textarea name="comment" id="comment" cols="30" rows="6" class="form-control" placeholder="Your Comment"></textarea>
      
               {{-- <div class="form-check mt-3">
                 <input class="form-check-input" type="checkbox" id="gridCheck">
                 <label class="form-check-label" for="gridCheck">
                   Save my name, email, and website in this browser for the next time I comment.
                 </label>
               </div>   --}}
               <button type="submit" class="btn btn-main mt-4">Add Comment</button> 
           </div>
        </form>  
        @include("pages.blogs.commentsDisplay",['comments' => $comment->replies])
      </div>
    </div>
    @endforeach
@endif