@extends('admin.layouts.app')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Permission</h3>
                <p class="text-subtitle text-muted">A pretty helpful component to show emphasized information to the user.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Permission</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section" id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            Add New Permission
                        </div>
                        <div class="float-end">
                            <a href="{{ route('admin.permissions.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.permissions.store') }}" method="post">
                            @csrf

                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start">Name</label>
                                <div class="col-md-6">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}">
                                    @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Permission">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </section>
</div>

@endsection