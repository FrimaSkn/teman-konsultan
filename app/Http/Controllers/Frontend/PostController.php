<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return view('frontend.pages.post.index');
    }

    public function show($slug)
    {
        $post = \App\Models\Post::where('slug', $slug)->firstOrFail();
        return view('frontend.pages.post.show', compact('post'));
    }
}
