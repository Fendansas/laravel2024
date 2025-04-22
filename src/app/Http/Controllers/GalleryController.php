<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(User $user)
    {
        $images = $user->images()->latest()->get();
        return view('gallery.index', compact('user', 'images'));
    }

    public function show(Image $image)
    {
        return view('gallery.show', compact('image'));
    }

    public function create()
    {
        return view('gallery.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'image'=>'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title'=>'nullable|string|max:255',
            'description'=>'nullable|string'
        ]);

        $path = $request->file('image')->store('public/gallery');

        auth()->user()->images()->create([
            'path'=>str_replace('public/', 'storage/', $path),
            'title'=>$request->title,
            'description' => $request->description
        ]);

        return redirect()
            ->route('gallery.index', auth()
            ->user())
            ->with('success', 'Image uploaded successfully.');
    }

    public function destroy(Image $image)
    {
        $this->authorize('delete', $image);

        $filePath = str_replace('storage/', 'public/', $image->path);
        Storage::delete($filePath);

        $image->delete();

        return redirect()->route('gallery.index', auth()->user())->with('success', 'Image deleted successfully.');
    }
}
