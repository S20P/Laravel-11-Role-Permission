@extends('admin.layouts.app')

@section('content')
<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Edit Comment </h3>
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
        <div class="row justify-content-center">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            Edit Comment for Blog : <b>{{$comment->blog->title??''}}</b>
                        </div>
                        <div class="float-end">
                            <a href="{{ route('admin.comments.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.comments.update', $comment->id) }}" method="post">
                            @csrf
                            @method("PUT")

                            <div class="mb-3 row">
                                <label for="comment" class="col-md-4 col-form-label text-md-end text-start">Comment</label>
                                <div class="col-md-6">
                                    <textarea class="form-control @error('comment') is-invalid @enderror" id="comment" name="comment">{{ $comment->comment }}</textarea>
                                    @if ($errors->has('comment'))
                                        <span class="text-danger">{{ $errors->first('comment') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group field mb-3">
                                <label for="">Status :  </label>
                                <div class="form-check form-check-inline pl-2">
                                    <input class="form-check-input" type="radio" value="active" name="status" id="active"
                                           @checked($comment->status=="Active")>
                                    <label class="form-check-label" for="active">
                                        Active
                                    </label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" value="deactive"  name="status" id="deactive"
                                      @checked($comment->status=="Inactive")>
                                    <label class="form-check-label" for="deactive">
                                        Inactive
                                    </label>
                                </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Update">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </section>
</div>
@endsection