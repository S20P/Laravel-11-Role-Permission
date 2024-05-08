@extends('admin.layouts.app')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Category List</h3>
                <p class="text-subtitle text-muted">A pretty helpful component to show emphasized information to the user.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">Category List</div>
            <div class="card-body">

                @haspermission('create-category','admin')
                    <a href="{{ route('admin.categories.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Category</a>
                @endhaspermission

                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->description }}</td>
                            <td>
                                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    @haspermission('edit-category','admin')
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @endhaspermission

                                    @haspermission('delete-category','admin')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this category?');"><i class="bi bi-trash"></i> Delete</button>
                                    @endhaspermission
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="4">
                                <span class="text-danger">
                                    <strong>No Category Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $categories->links() }}

            </div>
        </div>
    </section>
</div>

@endsection