@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-danger">
                <h4>{{ \Illuminate\Support\Facades\Session::get('success') }}</h4>
            </div>
        @endif
        <div class="card">
            <div class="card-header">Post Update</div>

            <div class="card-body">
                <form method="POST" action="/posts/{{ $post->id }}" enctype="multipart/form-data">
                    @csrf
                    @method('PATCh')

                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                        <div class="col-md-6">
                            <input id="title"
                                   type="text"
                                   class="form-control"
                                   value="{{ old('title') ?? $post->title }}"
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
                                   value="{{ old('content') ?? $post->content }}"
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
                            <input id="image" type="file" class="form-control-file"
                                   value="{{ old('image')}}" name="image">

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
