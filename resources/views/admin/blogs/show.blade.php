@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Blog Information</h3>
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
                            Blog Information
                        </div>
                        <div class="float-end">
                            <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Featured Image:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    <img src="{{ asset('uploads/blogs/'.$blog->image) }}" class="img-fluid img-thumbnail" width="150"> 
                                </div>
                            </div>

                            <div class="row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Title:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $blog->title }}
                                </div>
                            </div>

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Short Description:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $blog->short_description }}
                                </div>
                            </div>

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Body:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $blog->body }}
                                </div>
                            </div>

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Published At:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{date('Y-m-d', strtotime($blog->published_at))}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Status:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$blog->status}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Author Name:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$blog->author_name}}
                                </div>
                            </div>

                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Categories:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                     <ul>
                                        @foreach ($blog->categories as $category)
                                        <li>{{ $category->name }}</li>
                                        @endforeach
                                     </ul>
                                </div>
                            </div>


                            @if($meta_info)
                            <!----  Meta Infors ------->
                            <div class="divider">
                                <div class="divider-text">Meta Tags</div>
                            </div>

                            @if(isset($meta_info['title']))
                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Meta Title</strong></label>
                                 <div class="col-md-6" style="line-height: 35px;">
                                    {{$meta_info['title']}}
                                </div>                            
                            </div>
                            @endif

                            @if(isset($meta_info['description']))
                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Meta Description</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$meta_info['description']}}
                                </div>                               
                            </div>
                            @endif

                            @if(isset($meta_info['keywords']))
                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Meta Keywords</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$meta_info['keywords']}}
                                </div>                                
                            </div>
                            @endif

                            @if(isset($meta_info['author']))
                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>Meta Author</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$meta_info['author']}}
                                </div>                              
                            </div>
                            @endif


                            <div class="divider">
                                <div class="divider-text"> Open Graph (for Social Media)</div>
                            </div>

                            @if(isset($meta_info['og_type']))
                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>OG Type</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$meta_info['og_type']}}
                                </div>                               
                            </div>
                            @endif

                            @if(isset($meta_info['og_title']))
                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>OG Title</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$meta_info['og_title']}}
                                </div>                              
                            </div>
                            @endif

                            @if(isset($meta_info['og_description']))
                            <div class="row">
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>OG Description</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{$meta_info['og_description']}}
                                </div>                                
                            </div>                          
                             @endif

                            @if(isset($meta_info['og_image']))
                                <div class="row">                                    
                                  <label for="description" class="col-md-4 col-form-label text-md-end text-start"><strong>OG Image</strong></label>
                                  <div class="col-md-6" style="line-height: 35px;">
                                    <img src="{{ asset('uploads/blogs/'.$meta_info['og_image']) }}" class="img-fluid img-thumbnail" width="150">                                          
                                   </div>                                 
                                </div>                         
                            @endif

                            <!----  Meta Infors END------->
                         @endif
               
                    </div>
                </div>
            </div>    
        </div>
    </section>
</div>
@endsection