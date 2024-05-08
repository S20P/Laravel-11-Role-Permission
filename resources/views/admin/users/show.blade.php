@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>User Information</h3>
                <p class="text-subtitle text-muted">A pretty helpful component to show emphasized information to the user.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">User</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            User Information
                        </div>
                        <div class="float-end">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">

                            <div class="mb-3 row">
                                <label for="name" class="col-md-4 col-form-label text-md-end text-start"><strong>Name:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $user->name }}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="email" class="col-md-4 col-form-label text-md-end text-start"><strong>Email Address:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    {{ $user->email }}
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="roles" class="col-md-4 col-form-label text-md-end text-start"><strong>Roles:</strong></label>
                                <div class="col-md-6" style="line-height: 35px;">
                                    @forelse ($user->getRoleNames() as $role)
                                        <span class="badge bg-primary">{{ $role }}</span>
                                    @empty
                                    @endforelse
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>  
    </section>
</div>  
@endsection