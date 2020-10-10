<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['index','show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'DESC')->latest()->simplePaginate(15);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => '',
            'image' => 'image'
        ]);

        $imagePath = '';
        if(isset($data['image'])){
            $imagePath = $data['image']->store('posts_image', 'public');
        }

        $request->user()->posts()->create([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $imagePath
        ]);

        $user = auth()->user()->id;

        return redirect("/user/$user");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
//        dd('ahad');
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $data = $request->validate([
            'title' => 'required',
            'content' => '',
            'image' => 'image'
        ]);

        if(isset($data['image'])){
            if($post->image){
//                dd($post->image);
                $storage_path = storage_path();
                $old_image_path = "$storage_path/app/public/$post->image";
//                dd($old_image_path);
                if(File::exists($old_image_path)){
                    File::delete($old_image_path);
                }
            }
            $imagePath = $data['image']->store('posts_image', 'public');
            $post->update([
                'title' => $data['title'],
                'content' => $data['content'],
                'image' => $imagePath
            ]);
        }
        else{
//            dd('image not added');
            $post->update($data);
        }
//        dd($data);
        return redirect("/posts/$post->id/edit")->with('success', "Post Updated.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        $post_user = $post->user->id;
        if(isset($post->image)){
            $storage_path = storage_path();
            $old_image_path = "$storage_path/app/public/$post->image";
            if(File::exists($old_image_path)){
                File::delete($old_image_path);
            }
        }
        $post->delete();
        return redirect("/user/$post_user")->with('success', 'Post Deleted.');
    }
}
