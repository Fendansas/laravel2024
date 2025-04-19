<?php

namespace App\Http\Controllers;

use App\Models\Comment;
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

    public function addComment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000'
        ]);

        $comment = new Comment([
            'content' => $request->content,
            'user_id' => Auth::id()
        ]);

        $post->comments()->save($comment);

        return back()->with('success', 'Comment added successfully');
    }

    public function updateComment(Request $request, Post $post, Comment $comment)
    {
        $this->authorize('update', $comment);

        $request->validate([
            'content' => 'required|string|max:1000'
        ]);
        $comment->update([
            'content' => $request->content
        ]);
        return back()->with('success', 'Comment updated successfully');
    }

    public function deleteComment(Post $post, Comment $comment){

        $this->authorize('delete', $comment);
        $comment->delete();

        return back()->with('success', 'Comment deleted successfully');

    }

}
