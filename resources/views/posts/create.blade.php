@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">Profile Update</div>

            <div class="card-body">
                <form method="post" action="/posts" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                        <div class="col-md-6">
                            <input id="title"
                                   type="text"
                                   class="form-control"
                                   value="{{ old('title')}}"
                                   name="title">

                            @error('title')
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="content" class="col-md-4 col-form-label text-md-right">Content</label>

                        <div class="col-md-6">
                            <input id="content"
                                   type="text"
                                   class="form-control"
                                   value="{{ old('content')}}"
                                   name="content">

                            @error('content')
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="image" class="col-md-4 col-form-label text-md-right">Image</label>

                        <div class="col-md-6">
                            <input id="image" type="file" class="form-control-file" value="{{ old('image')}}" name="image">

                            @error('image')
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary">
                                Post
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
