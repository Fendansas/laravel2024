<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Details') }}
        </h2>
        <a href="{{ route('posts.create') }}" class="btn btn-success mb-3">Create New Post</a>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8">
                                <!-- Пост -->
                                @include('partials.star-rating', ['post' => $post])
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h2>{{ $post->title }}</h2>
                                        <small>Posted by: {{ $post->user->name }}</small>
                                        <small class="float-right">{{ $post->created_at->format('d.m.Y H:i') }}</small>
                                    </div>
                                    <div class="card-body">
                                        @if($post->image)
                                            <div class="mb-4">
                                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="img-fluid rounded">
                                            </div>
                                        @endif
                                        <p class="card-text">{{ $post->content }}</p>
                                    </div>
                                    @auth
                                        <div class="card-footer">
                                            @can('update', $post)
                                                <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-primary">Edit</a>
                                            @endcan
                                            @can('delete', $post)
                                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            @endcan
                                        </div>
                                    @endauth
                                </div>

                                <!-- Секция комментариев -->
                                <div class="card mb-4">
                                    <div class="card-header">
                                        <h4>Comments ({{ $post->comments->count() }})</h4>
                                    </div>
                                    <div class="card-body">
                                        @foreach($post->comments as $comment)
                                            <div class="media mb-4">
                                                <div class="media-body">
                                                    <h5 class="mt-0">{{ $comment->user->name }}</h5>
                                                    <small class="text-muted">{{ $comment->created_at->format('d.m.Y H:i') }}</small>
                                                    <p>{{ $comment->content }}</p>

                                                    @auth
                                                        @if(auth()->user()->can('delete', $comment))
                                                            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="d-inline">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Delete this comment?')">Delete</button>
                                                            </form>
                                                        @endif
                                                    @endauth
                                                </div>
                                            </div>
                                            @if(!$loop->last)
                                                <hr>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Форма добавления комментария -->
                                @auth
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Add a comment</h4>
                                        </div>
                                        <div class="card-body">
                                            <form action="{{ route('posts.comments.store', $post) }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="3" placeholder="Your comment..." required></textarea>
                                                    @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                @else
                                    <div class="alert alert-info">
                                        <a href="{{ route('login') }}">Login</a> to post comments.
                                    </div>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
