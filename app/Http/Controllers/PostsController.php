<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return view('posts.index' , compact('posts'));
    }

    public function store(Request $request, Post $post)
    {
        request()->validate([
            'image' => 'required|file|image|mimes:jpeg,png'
        ]);

        $imageHashName = request()->file('image')->hashName();

        $imagePath = request()->file('image')->storeAs('/images', $imageHashName , 'public');

        $post->path = $imagePath;
        $post->save();

        return redirect('/posts');
    }
}
