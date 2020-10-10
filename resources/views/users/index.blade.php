@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-row">
            <div class="col-sm-4 my-col">
                <div>
                    <img src="{{ $url_user_arg->profileImage()  }}" alt="" style="width: 300px">
                </div>
            </div>
            <div class="col-sm-8 my-col">
               <div>{{ $url_user_arg->name }}</div>
                <div>{{ $url_user_arg->bio }}</div>
                @if($url_user_arg->id == $requested_user->id)
                    <div>
                        <a href="/user/{{ auth()->user()->id }}/edit">Edit Profile</a>
                    </div>
                @endif

            </div>
        </div>
        <div class="row my-row">
            @foreach($posts as $post)
                <div class="pb-5">
                    <div class="row">
                        <div class="col-1">
                            <img class="rounded-circle img-thumbnail" src="{{ $url_user_arg->profileImage() }}" alt="">
                        </div>
                        <div class="col-6 align-items-baseline font-weight-bold">
                            <a href="/user/{{ $post->user->id }}">{{ $url_user_arg->name }}</a>
                        </div>
                    </div>
                    <div class="row pt-2">
                        <div class="col pl-4">
                            <a class="font-weight-bold" href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </div>
                    </div>
                    @if($post->content)
                        <div class="row pt-2 pb-4">
                            <div class="col">
                                <p>
                                    {{ $post->content }}
                                </p>
                            </div>
                        </div>
                    @endif
                    @if($post->image)
                        <div class="row">
                            <div class="col">
                                <a href="#">
                                    <img src="/storage/{{ $post->image }}" alt="" class="w-100" style="width: 500px;">
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection
