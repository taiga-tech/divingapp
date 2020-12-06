<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\PostComment;
use Illuminate\Support\Facades\Auth;

class PostCommentsController extends Controller
{
    public function __construct(PostComment $comments)
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->comments = $comments;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $comment = new PostComment;
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $input['profile_id'] = Auth::user()->profile->id;
        $comment = $this->comments->create($input);
        $comment = PostComment::with('user', 'profile')
            ->find($comment->id);

        return $comment;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = $this->comments->find($id);
        if (Auth::user()->profile->id == $comment->profile->id)
        {
            $comment->delete();
        }

        return $comment;
    }
}
