<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function create(\App\Post $post)
    {
        /**
         *
         * We could have done this in the controller but best practise is to do
         * move this in he Post Model.
        * \App\Comment::create([
        *    'body' => request('commentBody'),
        *    'post_id' => $post->id
        * ]);
        */
        $this->validate(request(), ['commentBody' => 'required|min:2']);
        $post->createComment(request('commentBody'));
        return back();
    }
}
