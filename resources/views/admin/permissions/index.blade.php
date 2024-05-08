@extends('admin.layouts.app')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Permission List</h3>
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
    <section class="section">
        <div class="card">
            <div class="card-header">Permission List</div>
            <div class="card-body">
             
                <a href="{{ route('admin.permissions.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Permission</a>

                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Guard</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($permissions as $permission)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name  }}</td>
                            <td>
                                <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <a href="{{ route('admin.permissions.show', $permission->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>
                                    <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this permission?');"><i class="bi bi-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="4">
                                <span class="text-danger">
                                    <strong>No Permission Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $permissions->links() }}

            </div>
        </div>
    </section>
</div>

@endsection