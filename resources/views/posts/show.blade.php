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
    </div>
@endsection
