<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index(Request $request, $url_user_arg)
    {
        $user = auth()->user()->id;
        $posts = Post::where('user_id', $user)->latest()->simplePaginate(15);
        return view('users.index', compact('requested_user', 'url_user_arg', 'posts'));
    }

    public function edit(User $user){
        $this->authorize('update', $user );
        return view('users.edit', compact('user'));
    }

    public function update(User $user){
        $this->authorize('update', $user);
        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'bio' => '',
            'image' => ''
        ]);
        $imagePath = '';
        if(request('image')){
            $imagePath = request('image')->store('profiles', 'public');
        }
//        dd(auth()->user());
        auth()->user()->update(array_merge($data, ['image' => $imagePath]));

        return redirect("/user/{$user->id}");
    }
}
