<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GalleryController;
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

Route::put('/posts/{post}', [PostController::class, 'update'])
    ->name('posts.update')
    ->middleware('auth');

Route::get('posts/{post}/edit',[PostController::class, 'edit'])
    ->name('posts.edit')
    ->middleware('auth');

Route::get('/posts/{post}',[PostController::class,'show'])->name('posts.show');

// Комментарии
Route::post('/posts/{post}/comments', [PostController::class, 'addComment'])
    ->name('posts.comments.store');
Route::delete('/comments/{comment}', [PostController::class, 'deleteComment'])
    ->name('comments.destroy');
Route::put('/comments/{comment}', [PostController::class, 'updateComment'])
    ->name('comments.update');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('auth');
Route::get('/users/{user}',[UserController::class, 'show'])->name('users.show')->middleware('auth');


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

Route::post('/posts/{post}/rate', [PostController::class, 'rate'])
    ->name('posts.rate')
    ->middleware('auth');

Route::middleware(['auth'])->group(function (){
    Route::get('/users/{user}/gallery',[GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::get('/gallery/{image}', [GalleryController::class, 'show'])->name('gallery.show');
    Route::delete('/gallery/{image}', [GalleryController::class, 'destroy'])->name('gallery.destroy');
    Route::post('/gallery',[GalleryController::class, 'store'])->name('gallery.store');

});


require __DIR__.'/auth.php';
