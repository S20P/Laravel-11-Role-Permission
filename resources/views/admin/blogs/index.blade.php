@extends('admin.layouts.app')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>blogs List</h3>
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
        <div class="card">
            <div class="card-header">Blogs List</div>
            <div class="card-body">

                @haspermission('create-blog','admin')
                    <a href="{{ route('admin.blogs.create') }}" class="btn btn-success btn-sm my-2"><i class="bi bi-plus-circle"></i> Add New Blog</a>
                @endhaspermission

                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <th scope="col">Body</th>                       
                        <th scope="col">Author</th>
                        <th scope="col">Published At</th>
                        <th scope="col">Created at</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $blog)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $blog->image }}</td>
                            <td>{{ $blog->title }}</td>
                            <td>{{ $blog->short_description }}</td>
                            <td>{{ $blog->author_name }}</td>
                            <td>{{ date('Y-m-d', strtotime($blog->published_at)) }}</td>
                            <td>{{ date('Y-m-d', strtotime($blog->created_at)) }}</td>
                            <td>{{ $blog->status }}</td>
                            <td>
                                <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a>

                                    @haspermission('edit-blog','admin')
                                        <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                    @endhaspermission

                                    @haspermission('delete-blog','admin')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this blog?');"><i class="bi bi-trash"></i> Delete</button>
                                    @endhaspermission
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="9">
                                <span class="text-danger">
                                    <strong>No Blogs Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $blogs->links() }}

            </div>
        </div>
    </section>
</div>

@endsection