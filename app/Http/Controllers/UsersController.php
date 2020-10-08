<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UsersController extends Controller
{
    public function index(Request $request, $url_user_arg)
    {
        $requested_user = $request->user();
        $url_user_arg = User::findOrFail($url_user_arg);
//        dd($requested_user->name);
//        dd($url_user_arg);
        return view('users.index', compact('requested_user', 'url_user_arg'));
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
