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
            post section
        </div>
    </div>
@endsection
