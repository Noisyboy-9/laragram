<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = auth()->user()->posts;
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request, Post $post)
    {
        request()->validate([
            'image' => 'required|file|image|mimes:jpeg,png'
        ]);

        $imageHashName = request()->file('image')->hashName();

        $imagePath = request()->file('image')->storeAs('/images', $imageHashName, 'public');

        $post = auth()->user()->posts()->create([
            'path' => $imagePath
        ]);


        if ($request->wantsJson()) {
            return $post;
        }
        return back();
    }

    public function destroy(Post $post)
    {
        if (auth()->id() != $post->owner_id) {
            abort(403);
        }

        $post->delete();

        if (\request()->wantsJson()) {
            return $post;
        }
        return redirect('/posts');
    }
}
