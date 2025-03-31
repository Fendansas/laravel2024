<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
//        $posts = Post::with('user')->latest()->get();
        $posts = Post::with('user')->latest()->paginate(2);
        return view('posts.index', compact('posts'));
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string'
        ]);

        $post = Auth::user()->posts()->create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }
//    public function create()
//    {
//        return "Test page - Create Post";
//    }

}
