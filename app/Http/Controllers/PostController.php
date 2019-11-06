<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        //$posts = \App\Post::all();
        //$posts = \App\Post::latest()->get();
        //$$posts = \App\Post::orderBy('created_at', 'asc')->get();
        $posts = \App\Post::orderBy('created_at', 'desc')->get();

        return view('posts.index', compact('posts'));
    }

    public function show(\App\Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        //dd(request()->all());
        //dd(request('blogTitle'));
        //dd(request['blogTitle', 'blogBody');
        //dd(request(['blogTitle', 'blogBody']));

        /** Example1 to save
        $post = new \App\Post;
        $post->title = request('blogTitle');
        $post->body = request('blogBody');
        $post->save();
        */

        /**
         * Preferred, Example2 to save
         * Notes: This is the better way to store to database but for this to
         * work you have to tell your model which values are fillables
         */

        /**
         * Validate input form, if validation fails, validator returns user to the form page.
         * and sends and error objeect
         */
        $this->validate(request(), [
            'blogTitle' => 'required|min:5',
            'blogBody' => 'required|max:100'
        ]);

        \App\Post::create([
            'title' => request('blogTitle'),
            'body' => request('blogBody'),
            'user_id' => \Auth::user()->id
        ]);


        return redirect("/");
    }
}
