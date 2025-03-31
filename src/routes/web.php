<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Route;
use App\Models\Group;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/about', function () {
    return view('about');
})->name('about');
Route::get('/contact', function () {
    return view('contact');
})->name('contact');

Route::get('/posts/', [PostController::class, 'index'])->name('posts.index');

//Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
Route::get('/posts/create', [PostController::class, 'create'])
    ->name('posts.create')
    ->middleware('auth');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

Route::get('/groups', function () {
    $groups = Group::with('post')->get();
    return view('groups',
        ['groups' => $groups,]);
})->name('groups');

Route::get('/groups/{id}', function ($id) {
    $group =Group::find($id);
    return view('group',['group'=>$group]);
})->name('group' );

Route::get('/user-page', function () {
    return view('user-page');
})->middleware('auth','is_admin:admin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
