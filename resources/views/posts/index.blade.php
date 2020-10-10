@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row pb-4">
            <div class="pl-lg-4">
                <a href="/posts/create">Add Post</a>
            </div>
        </div>
        @foreach($posts as $post)
            <div class="pb-5">
                <div class="row">
                    <div class="col-1">
                        <img class="rounded-circle img-thumbnail" src="{{ $post->user->profileImage() }}" alt="">
                    </div>
                    <div class="col-6 align-items-baseline font-weight-bold">
                        <a href="#">{{ $post->user->name }}</a>
                    </div>
                </div>
                <div class="row pt-2">
                    <div class="col pl-4">
                        <a class="font-weight-bold">{{ $post->title }}</a>
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
@endsection
