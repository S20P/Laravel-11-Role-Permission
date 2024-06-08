@extends('admin.layouts.app')
@section('content')

@push('styles')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"> 
 <style>
    .icon-preview {
        display: inline-flex;
        align-items: center;
   }
    .icon-preview i {
        margin-right: 10px;
    }
    .select2-results__option .icon-preview {
        display: inline-flex;
        align-items: center;
    }
    .select2-results__option .icon-preview i {
        margin-right: 10px;
  
    }
    .select2-container {
        width: 100% !important;
    }
</style>
@endpush

<input type="hidden" value="{{ route('admin.sm-settings.ajax') }}" id="sm_settings_ajax_url">
<input type="hidden" value="{{ route('admin.settings.ajax') }}" id="settings_ajax_url">


<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Social Media Links Settings </h3>
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
                        <div class="float-end">
                            <div class="form-check form-switch">
                                <input class="form-check-input" id="setting_social_media_status" name="social_media_enabled" type="checkbox" @if(isset($g_common_settings['social_media_enabled']) && $g_common_settings['social_media_enabled']=="active") value="active" checked="" @else value="inactive" @endif>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Is Display Social Media Section</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="sm_settings_form" method="post">
                           @csrf
                            <span id="result"></span>
                            <div class="table-responsive">  
                                <table class="table table-bordered" id="add_more_media_box"> 
                                    <thead>
                                        <tr>                                      
                                            <th scope="col">NAME</th>
                                            <th scope="col">URL</th>
                                            <th scope="col">ICON</th>                       
                                            <th scope="col">SORT ORDER</th>
                                            <th scope="col">STATUS</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($settings_info) > 0)
                                    @foreach($settings_info as $setting)
                                       @include("admin.settings.social-media.new-block",["setting" => $setting,"media_icons" => $media_icons, "index"=>$loop->iteration])
                                    @endforeach
                                    @endif
                                    </tbody>
                                </table>                                 
                            </div>

                            <input type="hidden" value="store" name="action">
                            
                            <div class="col-12 d-flex justify-content-end">
                                <button type="submit" id="submit" class="btn btn-primary me-1 mb-1">Save</button>                                
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
 <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script> 
 <script src="{{asset('Admin/custom/js/social-media.js')}}"></script>
@endpush
@endsection