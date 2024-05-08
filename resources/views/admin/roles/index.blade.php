@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Roles List</h3>
                <p class="text-subtitle text-muted">A pretty helpful component to show emphasized information to the user.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Roles</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">Manage Roles</div>
            <div class="card-body">
                @haspermission('create-role','admin')
                    <a href="{{ route('admin.roles.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Role</a>
                @endhaspermission
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Name</th>
                        <th scope="col" style="width: 250px;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($roles as $role)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $role->name }}</td>
                            <td>
                                <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.roles.show', $role->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    @if ($role->name!='super-admin')
                                        @haspermission('edit-role','admin')
                                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>   
                                        @endhaspermission

                                        @haspermission('delete-role','admin')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this role?');"><i class="bi bi-trash"></i> Delete</button>
                                        @endhaspermission
                                    @endif

                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="3">
                                <span class="text-danger">
                                    <strong>No Role Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $roles->links() }}

            </div>
        </div>
    </section>
</div>
@endsection