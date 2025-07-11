<?php

namespace App\Http\Controllers\Backend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        return view('backend.post.index');
    }

    public function create()
    {
        return view('backend.post.create');
    }

    public function edit(Post $post)
    {
        return view('backend.post.edit', [
            'post' => $post
        ]);
    }
}
