@extends('admin.layouts.app')

@section('content')

<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3>Add Category</h3>
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
    <section class="section" id="multiple-column-form">
        <div class="row match-height">
            <div class="col-12">

                <div class="card">
                    <div class="card-header">
                        <div class="float-start">
                            Add New Category
                        </div>
                        <div class="float-end">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-primary btn-sm">&larr; Back</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.categories.store') }}" method="post">
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
                                <label for="description" class="col-md-4 col-form-label text-md-end text-start">Description</label>
                                <div class="col-md-6">
                                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group field mb-3 row">
                                <label for="" class="col-md-4 col-form-label text-md-end text-start">Is Show On Menu Status :  </label>
                                <div class="col-md-6">
                                        <div class="form-check form-check-inline pl-2">
                                            <input class="form-check-input" type="radio" value="1" name="is_show_on_menu" id="is_show_on_menu_active" checked>
                                            <label class="form-check-label" for="is_show_on_menu_active">
                                                YES
                                            </label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="0"  name="is_show_on_menu" id="is_show_on_menu_deactive">
                                            <label class="form-check-label" for="is_show_on_menu_deactive">
                                                NO
                                            </label>
                                        </div>
                              </div>
                            </div>
                            
                            <div class="mb-3 row">
                                <label for="menu_sort" class="col-md-4 col-form-label text-md-end text-start">Menu sort order </label>
                                <div class="col-md-6">
                                <input type="number" class="form-control @error('menu_sort') is-invalid @enderror" id="menu_sort" name="menu_sort" value="{{ old('menu_sort') }}">
                                    @if ($errors->has('menu_sort'))
                                        <span class="text-danger">{{ $errors->first('menu_sort') }}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group field mb-3 row">
                                <label for="" class="col-md-4 col-form-label text-md-end text-start">Status :  </label>
                                <div class="col-md-6">
                                    <div class="form-check form-check-inline pl-2">
                                        <input class="form-check-input" type="radio" value="1" name="status" id="active" checked>
                                        <label class="form-check-label" for="active">
                                            YES
                                        </label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" value="0"  name="status" id="deactive">
                                        <label class="form-check-label" for="deactive">
                                            NO
                                        </label>
                                    </div>
                                </div>
                            </div>
                            

                            <div class="mb-3 row">
                                <input type="submit" class="col-md-3 offset-md-5 btn btn-primary" value="Add Category">
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>    
        </div>
    </section>
</div>

@endsection