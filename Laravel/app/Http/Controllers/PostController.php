<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(2);
        return view('posts.index',[
            'posts' => $posts
        ]);
    }
    public function store(Request $request)
    {
       $this->validate($request,[
           'body' => 'required'
       ]);
       $request->user()->posts()->create($request->only('body'));     
       return back();
    //    auth()->user()->posts()->create();
    }
}

