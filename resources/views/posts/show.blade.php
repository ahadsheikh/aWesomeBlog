@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="pb-5">
            <div class="row">
                <div class="col-2">
                    <img class="rounded-circle img-thumbnail" src="{{ $post->user->profileImage() }}" alt="">
                </div>
                <div class="col align-items-baseline font-weight-bold">
                    <a href="/user/{{ $post->user->id }}" style="font-size: 25px">{{ $post->user->name }}</a>
                    <div>
                        <p style="font-size: 13px">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                @if(auth()->check())
                    @if(auth()->user()->id == $post->user->id)
                        <div class="">
                            <a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a>
                        </div>
                        <div class="pl-2 pr-4">
                            <form action="/posts/{{ $post->id }}" method="post">
                                @csrf
                                @method('DELETE')

                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    @endif
                @endif
            </div>
            <div class="row">
                <div class="col pl-4">
                    <a class="font-weight-bold" style="font-size: 20px">{{ $post->title }}</a>
                </div>
            </div>
            @if($post->content)
                <div class="row pl-2">
                    <div class="col">
                        <p style="font-size: 16px">
                            {{ $post->content }}
                        </p>
                    </div>
                </div>
            @endif
            @if($post->image)
                <div class="row">
                    <div class="col pl-4">
                        <img src="/storage/{{ $post->image }}" alt="" width="400px">
                    </div>
                </div>
            @endif
        </div>
        <hr style="border: none;
                   height: 1px;
                    color: #333;
                    background-color: #333;">
        <form action="/comments/{{ $post->id }}" method="post">
            @csrf
            <div class="form-group row">
                <div class="col-md-6">
                    <input id="content"
                           type="text"
                           class="form-control"
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
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary">
                        Comment
                    </button>
                </div>
            </div>
        </form>

        <div class="pt-5"></div>

        @foreach($comments as $comment)
            <div class="mt-4">
                <div class="row">
                    <div class="col-1">
                        <img class="rounded-circle img-thumbnail" src="{{ $comment->user->profileImage() }}" alt="">
                    </div>
                    <div class="col-6 font-weight-bold" style="align-self: center; font-size: 20px">
                        <a href="/user/{{ $comment->user->id }}">{{ $comment->user->name }}</a>
                        <div>
                            <p style="font-size: 13px">{{ $comment->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                    @if(auth()->check())
                        @if(auth()->user()->id == $comment->user->id)
                            <div class="pl-2 pr-4">
                                <form action="/comments/{{ $comment->id }}" method="post">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        @endif
                    @endif
                </div>
                <div class="row">
                    <div class="col pl-5">
                        <p>{{ $comment->content }}</p>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
@endsection
