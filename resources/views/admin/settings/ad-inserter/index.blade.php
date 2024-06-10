@extends('admin.layouts.app')
@section('content')

@push('styles')
<!-- include libraries(jQuery, bootstrap) -->
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <link rel="stylesheet" href="{{asset('Admin/assets/extensions/summernote/summernote-lite.css')}}">
 <link rel="stylesheet" href="{{asset('Admin/assets/compiled/css/form-editor-summernote.css')}}"> 
@endpush

<input type="hidden" value="{{ route('admin.ad-inserter-settings.ajax') }}" id="ad_inserter_settings_ajax_url">
<input type="hidden" value="{{ route('admin.settings.ajax') }}" id="settings_ajax_url">


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Ad Inserter Settings </h3>
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
                            Ad Inserter Settings
                        </div>
                        <div class="float-end">
                           
                        </div>
                    </div>


                    <div class="card-body">
                        <form action="{{ route('admin.ad-inserter-settings.store') }}" method="post">
                            @csrf
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($settings_info as $key=>$setting)
                            <li class="nav-item" role="presentation">
                                <a class="nav-link {{$loop->iteration==1?'active':''}}" id="block-tab{{$setting['id']}}" data-bs-toggle="tab" href="#block{{$setting['id']}}" role="tab"
                                    aria-controls="home" aria-selected="true">{{$loop->iteration}}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                           
                            @foreach($settings_info as $key=>$setting)
                            <div class="tab-pane fade  {{$loop->iteration==1?'show active':''}}" id="block{{$setting['id']}}" role="tabpanel" aria-labelledby="block-tab{{$setting['id']}}">

                                <input type="hidden" name="key[]"  value="{{$setting['key']??''}}" class="form-control name_list" />

                                <div class="form-group field mb-3">
                                    <label for="title" class="col-form-label">Block {{$loop->iteration}}</label>                        
                                    <textarea class="form-control textarea_html_block" rows="15" cols="200" name="value_block[]">{{$setting['value']??''}}</textarea>                               
                                </div> 
            
                                <div class="form-group">
                                     <label for="page_type">Page Type</label>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($pageTypes as $page_index=>$pageType)
                                            @php
                                                $page_type_array = explode(',', $setting['page_type']??'');
                                            @endphp
                                            <li class="d-inline-block me-2 mb-1">
                                                    <div class="form-check">
                                                        <div class="checkbox">
                                                            <input type="checkbox" name="page_type[{{$key}}][]" id="checkbox" value="{{ $pageType }}" class="form-check-input" @if(in_array($pageType, $page_type_array)) checked @endif>
                                                            <label for="checkbox1">{{ ucfirst(str_replace('_', ' ', $pageType)) }}</label>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                </div>
            
                                <div class="form-group">
                                     <label for="position">Position</label>
                                    <select name="position[]" id="position" class="form-control">
                                        @foreach($positions as $position)
                                            <option value="{{ $position }}" @if(isset($setting['position']) && $setting['position']==$position) selected @endif>{{ ucfirst(str_replace('_', ' ', $position)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
            
                                <div class="form-group">
                                    <label for="alignment">Alignment</label>
                                    <select name="alignment[]" id="alignment" class="form-control">
                                        @foreach($alignment as $position)
                                            <option value="{{ $position }}" @if(isset($setting['alignment']) && $setting['alignment']==$position) selected @endif>{{ ucfirst(str_replace('_', ' ', $position)) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endforeach

                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary me-1 mb-1">Save</button>                                
                            </div>
                          
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
       $('.textarea_html_block').summernote({
        placeholder: 'Block content',
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
