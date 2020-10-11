@extends('layouts.app')

@section('content')
    <div class="container">
        @if(\Illuminate\Support\Facades\Session::has('success'))
            <div class="alert alert-danger">
                <h4>{{ \Illuminate\Support\Facades\Session::get('success') }}</h4>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-4">
                <div>
                    <img src="{{ $user->profileImage()  }}" alt="" style="width: 300px">
                </div>
            </div>
            <div class="col-sm-8">
                <h3>{{ $user->name }}</h3>
                <p style="font-size: 18px">{{ $user->bio }}</p>
                @if(auth()->check())
                    @if(auth()->user()->id === $user->id)
                        <div>
                            <a class="btn btn-primary" href="/user/{{ auth()->user()->id }}/edit">Edit Profile</a>
                        </div>
                    @endif
                @endif
                @if(auth()->check())
                    @if(auth()->user()->id === $user->id)
                        <div class="row pb-4 pt-3">
                            <div class="pl-3">
                                <a href="/posts/create" class="btn btn-primary">Add Post</a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="row pt-4">
            @foreach($posts as $post)
                <div class="mb-5">
                    <div class="row">
                        <div class="col-1">
                            <img class="rounded-circle img-thumbnail" src="{{ $post->user->profileImage() }}" alt="">
                        </div>
                        <div class="col-6 font-weight-bold" style="align-self: center; font-size: 25px">
                            <a href="/user/{{ $post->user->id }}">{{ $post->user->name }}</a>
                            <div>
                                <p style="font-size: 13px">{{ $post->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col pl-4">
                            <a class="font-weight-bold" style="font-size: 20px" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
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
                                <a href="/posts/{{ $post->id }}">
                                    <img src="/storage/{{ $post->image }}" alt="" width="400px">
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
@endsection
