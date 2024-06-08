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
                <h3>Settings </h3>
                <p class="text-subtitle text-muted">A pretty helpful component to show emphasized information to the user.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Settings</li>
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
                            General Settings
                        </div>
                        
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.settings.store') }}" method="post">
                            @csrf

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Header</label>
                                <input type="hidden" name="settings_info[0][key]" value="header"> 
                                <textarea class="form-control" rows="15" cols="200" id="header" name="settings_info[0][value]">{{ $settings_info['header']??old('settings_info[0][value]') }}</textarea>                               
                            </div>

                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Footer</label>
                                <input type="hidden" name="settings_info[1][key]" value="footer"> 
                                <textarea class="form-control" rows="15" cols="200" id="footer" name="settings_info[1][value]">{{ $settings_info['footer']??old('settings_info[1][value]') }}</textarea>                               
                            </div>   
                            
                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Block</label>
                                <input type="hidden" name="settings_info[2][key]" value="block"> 
                                <textarea class="form-control" rows="15" cols="200" id="block" name="settings_info[2][value]">{{ $settings_info['block']??old('settings_info[2][value]') }}</textarea>                               
                            </div>   
                            
                            <div class="form-group field mb-3">
                                <label for="title" class="col-form-label">Sidebar Block</label>
                                <input type="hidden" name="settings_info[3][key]" value="blog_sidebar_block"> 
                                <textarea class="form-control" rows="15" cols="200" id="blog_sidebar_block" name="settings_info[3][value]">{{ $settings_info['blog_sidebar_block']??old('settings_info[3][value]') }}</textarea>                               
                            </div>   
                            
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>                                
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
       $('#blog_sidebar_block').summernote({
        placeholder: 'Blog Sidebar content body',
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