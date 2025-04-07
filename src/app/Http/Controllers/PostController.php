<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
//        $posts = Post::with('user')->latest()->get();
        $posts = Post::with('user')->latest()->paginate(10);
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
            'content' => 'required|string',
            'image'=>'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')){
            $path = $request->file('image')->store('posts', 'public');
            $validated['image']= $path;
        }

        $post = Auth::user()->posts()->create($validated);

        return redirect()->route('posts.index')->with('success', 'Post created successfully');
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($request->hasFile('image')) {
            // Удаляем старое изображение
            if ($post->image) {
                Storage::disk('public')->delete($post->image); // Исправлено: удаляем конкретный файл
            }

            // Сохраняем новое изображение
            $path = $request->file('image')->store('posts', 'public');
            $validated['image'] = $path;
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function show(Post $post)
    {
        $post->load('user');
        return view('posts.show',compact('post'));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);
        if ($post->image){
            Storage::disk('public')->delete($post->image);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }

}
