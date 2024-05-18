@extends('admin.layouts.app')

@section('content')
@push('styles')
<!-- include libraries(jQuery, bootstrap) -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <link rel="stylesheet" href="{{asset('Admin/assets/extensions/summernote/summernote-lite.css')}}">
 <link rel="stylesheet" href="{{asset('Admin/assets/compiled/css/form-editor-summernote.css')}}"> 
@endpush
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Blog </h3>
                <p class="text-subtitle text-muted">A pretty helpful component to show emphasized information to the user.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blogs</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            Edit Blog
                        </div>
                        <div class="float-end">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.blogs.update', $blog->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")

                            <div class="field mb-3">
                                <label class="label">Category</label>
                                <div class="control @error('categories_id') is-invalid @enderror">
                                    <div class="select">
                                        <select class="choices form-select multiple-remove" name="categories_id[]" multiple="multiple">
                                            <optgroup label="Select category">
                                          
                                              @foreach ($categories as $category)
                                                  <option value="{{ $category->id }}" @selected(in_array($category->id, $selectedCategores))>{{ $category->name }}</option>
                                              @endforeach 
                                            </optgroup>
                                            </select>
                                    </div>
                                    @if($errors->has('categories_id'))
                                        <span class="text-danger">{{ $errors->first('categories_id') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $blog->title }}">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                            </div>

                            <div class="form-group field mb-3">
                                <label for="short_description" class="col-form-label">Short Description</label>
                                    <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description" name="short_description">{{ $blog->short_description }}</textarea>
                                    @if ($errors->has('short_description'))
                                        <span class="text-danger">{{ $errors->first('short_description') }}</span>
                                    @endif
                            </div>

                            <div class="form-group field mb-3">
                                <label for="body" class="col-form-label">Body</label>
                                    <textarea class="form-control @error('body') is-invalid @enderror" id="body" name="body">{{ $blog->body }}</textarea>
                                    @if ($errors->has('body'))
                                        <span class="text-danger">{{ $errors->first('body') }}</span>
                                    @endif
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="published_at">Publish At</label>
                                        <input type="date" name="published_at"  class="form-control @error('published_at') is-invalid @enderror" {{ $blog->published_at }}>
                                        @if ($errors->has('published_at'))
                                            <span class="text-danger">{{ $errors->first('published_at') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                     <div class="form-group field mb-3">
                                        <fieldset>
                                            <div class="input-group mb-3">
                                                <label for="">Featured Image</label>
                                                <div class="input-group mb-3">                                       
                                                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"  accept="image/*">
                                                </div>                                                
                                            </div>
                                            @if ($errors->has('image'))
                                            <span class="text-danger">{{ $errors->first('image') }}</span>
                                            @endif
                                        </fieldset>     
                                        <img src="{{ asset('uploads/blogs/'.$blog->image) }}" class="img-fluid img-thumbnail" width="150">                                         
                                     </div>
                                </div>
                            </div>

                            <div class="form-group field mb-3">
                                <label for="">Status :  </label>
                                <div class="form-check form-check-inline pl-2">
                                    <input class="form-check-input" type="radio" value="Publish" name="status" id="active"
                                           @checked($blog->status=="Publish")>
                                    <label class="form-check-label" for="active">
                                        Publish
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="Draft" value="true" name="status" id="deactive"
                                    @checked($blog->status=="Draft")>
                                    <label class="form-check-label" for="deactive">
                                        Draft
                                    </label>
                                </div>
                            </div>

                         
                             <!----  Meta Infors ------->
                             <div class="divider">
                                <div class="divider-text">Meta Tags</div>
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Meta Title</label>
                                <input type="hidden" name="meta_info[0][meta_key]" value="title">                                
                                <input type="text" class="form-control" id="meta_title" name="meta_info[0][meta_value]" value="{{ $meta_info['title']??old('meta_info[0][meta_value]') }}">
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Meta Description</label>
                                <input type="hidden" name="meta_info[1][meta_key]" value="description"> 
                                <input type="text" class="form-control" id="meta_description" name="meta_info[1][meta_value]" value="{{ $meta_info['description']??old('meta_info[1][meta_value]') }}">
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Meta Keywords</label>
                                <input type="hidden" name="meta_info[2][meta_key]" value="keywords"> 
                                <input type="text" class="form-control" id="meta_keywords" name="meta_info[2][meta_value]" value="{{ $meta_info['keywords']??old('meta_info[2][meta_value]') }}">
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Meta Author</label>
                                <input type="hidden" name="meta_info[3][meta_key]" value="author"> 
                                <input type="text" class="form-control" id="meta_author" name="meta_info[3][meta_value]" value="{{ $meta_info['author']??old('meta_info[3][meta_value]') }}">
                            </div>


                            <div class="divider">
                                <div class="divider-text"> Open Graph (for Social Media)</div>
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">OG Type</label>
                                <input type="hidden" name="meta_info[4][meta_key]" value="og_type">                                
                                <input type="text" class="form-control" id="meta_og_type" name="meta_info[4][meta_value]" value="{{ $meta_info['og_type']??old('meta_info[4][meta_value]') }}">
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">OG Title</label>
                                <input type="hidden" name="meta_info[5][meta_key]" value="og_title">                                
                                <input type="text" class="form-control" id="meta_og_title" name="meta_info[5][meta_value]" value="{{ $meta_info['og_title']??old('meta_info[5][meta_value]') }}">
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">OG Description</label>
                                <input type="hidden" name="meta_info[6][meta_key]" value="og_description"> 
                                <input type="text" class="form-control" id="meta_og_description" name="meta_info[6][meta_value]" value="{{ $meta_info['og_description']??old('meta_info[6][meta_value]') }}">
                            </div>                          
                         

                            <div class="col-md-6">
                                <div class="form-group field mb-3">
                                   <fieldset>
                                       <div class="input-group mb-3">
                                           <label for="">OG : Image</label>
                                           <div class="input-group mb-3"> 
                                               <input type="hidden" name="meta_info[7][meta_key]" value="og_image">                                  
                                               <input type="file" name="meta_info[7][meta_value]" class="form-control"  accept="image/*">
                                           </div>                                                
                                       </div>                                      
                                   </fieldset> 
                                   @if($meta_info['og_image'])
                                   <img src="{{ asset('uploads/blogs/'.$meta_info['og_image']) }}" class="img-fluid img-thumbnail" width="150">                                          
                                   @endif
                                </div>
                           </div>

                            <!----  Meta Infors END------->
                         

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Submit</button>                                
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </section>
</div>
@push('scripts')  
<!-- include summernote css/js -->
 <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
 <script src="{{asset('Admin/assets/extensions/summernote/summernote-lite.min.js')}}"></script>
 <script src="{{asset('Admin/assets/static/js/pages/summernote.js')}}"></script> 
 <script>
    $(document).ready(function() {
       $('#body').summernote({
        placeholder: 'Blog content body',
        tabsize: 2,
        height: 250,
        toolbar: [
          ['style', ['style']],
          ['font', ['bold', 'underline', 'clear']],
          ['color', ['color']],
          ['para', ['ul', 'ol', 'paragraph']],
          ['table', ['table']],
          ['insert', ['link', 'picture', 'video']],
          ['view', ['fullscreen', 'codeview', 'help']]
        ]
       });
    });
</script>
@endpush

@endsection