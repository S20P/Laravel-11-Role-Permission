@extends('admin.layouts.app')

@section('content')
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
@endsection