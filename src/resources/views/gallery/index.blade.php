<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gallery') }}
        </h2>

        @auth
            @if(auth()->id() === $user->id)
                <a href="{{ route('gallery.create') }}" class="btn btn-primary mb-3">Upload Image</a>
            @endif
        @endauth
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <h1 class="mb-4">{{ $user->name }}'s Gallery</h1>
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            @foreach($images as $image)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <a href="{{ route('gallery.show', $image) }}">
                                            <img src="{{ asset($image->path) }}" class="card-img-top" alt="{{ $image->title }}" style="height: 200px; object-fit: cover;">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $image->title ?? 'Untitled' }}</h5>
                                            <p class="card-text">{{ Str::limit($image->description, 50) }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
