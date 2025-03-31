<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>

{{--        <div class="container">--}}
{{--            <h1>Create New Post</h1>--}}

{{--            <form action="{{ route('posts.store') }}" method="POST">--}}
{{--                @csrf--}}

{{--                <div class="form-group">--}}
{{--                    <label for="title">Title</label>--}}
{{--                    <input type="text" name="title" id="title" class="form-control" required>--}}
{{--                </div>--}}

{{--                <div class="form-group">--}}
{{--                    <label for="content">Content</label>--}}
{{--                    <textarea name="content" id="content" class="form-control" rows="5" required></textarea>--}}
{{--                </div>--}}

{{--                <button type="submit" class="btn btn-primary mt-3">Create Post</button>--}}
{{--            </form>--}}
{{--        </div>--}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <h1 class="mb-4">Создать новый пост</h1>

                        <form action="{{ route('posts.store') }}" method="POST">
                            @csrf

                            <div class="mb-4">
                                <label for="title" class="block text-gray-700 text-sm font-bold mb-2">
                                    Заголовок
                                </label>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                    placeholder="Введите заголовок поста"
                                >
                                @error('title')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="content" class="block text-gray-700 text-sm font-bold mb-2">
                                    Содержание
                                </label>
                                <textarea
                                    name="content"
                                    id="content"
                                    rows="6"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    required
                                    placeholder="Напишите содержание поста"
                                ></textarea>
                                @error('content')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between">
                                <button
                                    type="submit"
                                    class="bg-blue-500 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                >
                                    Опубликовать
                                </button>

                                <a
                                    href="{{ route('posts.index') }}"
                                    class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                                    Вернуться к списку
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
