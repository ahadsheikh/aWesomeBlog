<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{
    public function index(Request $request, $user_id)
    {
        $requested_user = $request->user();
        $posts = Post::where('user_id', $user_id)->latest()->simplePaginate(15);
        $user = User::findOrFail($user_id);
        return view('users.index', compact('requested_user', 'user', 'posts'));
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
            $this->resizeImage400($imagePath);
        }
//        dd(auth()->user());
        auth()->user()->update(array_merge($data, ['image' => $imagePath]));

        return redirect("/user/{$user->id}");
    }


    // Resize image with width 400 and keep height aspect ratio
    private function resizeImage400($imagePath){
        $image = Image::make(public_path("storage/$imagePath"))->resize(400, null, function ($constraint){
            $constraint->aspectRatio();
        });
        $image->save();
    }
}
