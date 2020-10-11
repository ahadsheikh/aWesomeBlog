<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $post_id)
    {
        $data = $request->validate([
            'content' => 'required|max:500'
        ]);
        $user_id = auth()->user()->id;

        $comments = Comment::create([
            'user_id' => $user_id,
            'post_id' => $post_id,
            'content' => $data['content']
        ]);

        $comments->save();

        return redirect("/posts/$post_id");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $post= $comment->post;
        $comment->delete();
        return redirect("/posts/$post->id");
    }
}
