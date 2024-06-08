@extends('admin.layouts.app')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Comments List</h3>
                <p class="text-subtitle text-muted">A pretty helpful component to show emphasized information to the user.</p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route("admin.dashboard")}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Comment</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="card">
            <div class="card-header">Comments List</div>
            <div class="card-body">
                <table class="table table-striped table-bordered table-responsive">
                    <thead>
                        <tr>
                        <th scope="col">S#</th>
                        <th scope="col">Blog</th>
                        <th scope="col">Comment</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>                        
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($comments as $comment)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{$comment->blog->title??''}}</td>
                            <td>{{ $comment->comment }}</td>
                            <td>{{ $comment->name }}</td>
                            <td>{{ $comment->email }}</td>
                            <td>
                                @if($comment->status=="Active")
                                   <span class="badge bg-success">Active</span> 
                                @else
                                  <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                            <td> 
                                <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    {{-- <a href="{{ route('admin.comments.show', $comment->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-eye"></i> Show</a> --}}

                                     @haspermission('edit-comment','admin') 
                                        <a href="{{ route('admin.comments.edit', $comment->id) }}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>
                                     @endhaspermission 

                                     @haspermission('delete-comment','admin') 
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this comment?');"><i class="bi bi-trash"></i> Delete</button>
                                     @endhaspermission 
                                </form>
                            </td>
                        </tr>
                        @empty
                            <td colspan="7">
                                <span class="text-danger">
                                    <strong>No Comment Found!</strong>
                                </span>
                            </td>
                        @endforelse
                    </tbody>
                </table>

                {{ $comments->links() }}

            </div>
        </div>
    </section>
</div>

@endsection