<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
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
                                <div class="card">
                                    <div class="card-header">
                                        <h2>{{ $post->title }}</h2>
                                        <small>Posted by: {{ $post->user->name }}</small>
                                        <small class="float-right">{{ $post->created_at->format('d.m.Y H:i') }}</small>
                                    </div>
                                    <div class="card-body">
                                        @if($post->image)
                                            <div class="mb-4">
                                                <img src="{{ asset('storage/' . $post->image) }}" alt="Post image" class="img-fluid">
                                            </div>
                                        @endif
                                        <p>{{ $post->content }}</p>
                                    </div>
                                    <div class="card-body">
                                        <p>{{ $post->content }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
