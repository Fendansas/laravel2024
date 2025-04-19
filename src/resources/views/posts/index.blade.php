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
                    <div class="container mt-5">
                        <h1 class="mb-4">Список постов</h1>

                        @if($posts->isEmpty())
                            <div class="alert alert-info">Постов пока нет.</div>
                        @else
                            <div class="row">
                                @foreach($posts as $post)
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            @include('partials.star-rating', ['post' => $post])
                                            <div class="card-body">
                                                <h5 class="card-title">{{ $post->title }}</h5>
                                                <p class="card-text">{{ Str::limit($post->content, 100) }}</p>
                                                <p class="text-muted">
                                                    Автор: {{ optional($post->user)->name ?? 'Неизвестный автор' }}
                                                </p>
                                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Читать далее</a>
                                                @can('update', $post)
                                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">Edit</a>
                                                @endcan
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                    <div class="mt-4">
                                        {{ $posts->links() }}
                                    </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
