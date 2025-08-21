<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(GeneralSettings $settings)
    {
        $posts = \App\Models\Post::Published()->paginate(12);
        return view('frontend.pages.post.index', [
            'posts' => $posts,
            'settings' => $settings
        ]);
    }

    public function show($slug)
    {
        $post = \App\Models\Post::FindBySlugOrFail($slug);
        return view('frontend.pages.post.show', [
            'post' => $post
        ]);
    }
}
