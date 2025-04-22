<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Image;
use App\Policies\CommentPolicy;
use App\Policies\PostPolicy;
use App\Policies\ImagePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Post::class => PostPolicy::class,
        Comment::class => CommentPolicy::class,
        Image::class => ImagePolicy::class,
    ];

    public function boot()
    {
        $this->registerPolicies();
    }
}
