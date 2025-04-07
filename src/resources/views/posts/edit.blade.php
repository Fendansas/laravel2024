<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <h1 class="mb-4 text-2xl font-bold">Редактировать пост</h1>

                        <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-6">
                                <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Заголовок</label>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    value="{{ old('title', $post->title) }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    required
                                >
                                @error('title')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Содержание</label>
                                <textarea
                                    name="content"
                                    id="content"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    rows="6"
                                    required
                                >{{ old('content', $post->content) }}</textarea>
                                @error('content')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-6">
                                <label for="image" class="block mb-2 text-sm font-medium text-gray-900">Изображение поста</label>
                                <input
                                    type="file"
                                    name="image"
                                    id="image"
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none"
                                    accept="image/jpeg,image/png,image/jpg,image/gif"
                                >
                                @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                @if($post->image)
                                    <div class="mt-4">
                                        <p class="text-sm text-gray-500 mb-2">Текущее изображение:</p>
                                        <img
                                            src="{{ asset('storage/' . $post->image) }}"
                                            alt="Current post image"
                                            class="max-h-64 rounded-lg shadow-md"
                                        >
                                        <div class="mt-2 flex items-center">
                                            <input
                                                type="checkbox"
                                                name="remove_image"
                                                id="remove_image"
                                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
                                            >
                                            <label for="remove_image" class="ml-2 text-sm font-medium text-gray-900">
                                                Удалить изображение
                                            </label>
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="flex items-center space-x-4">
                                <button
                                    type="submit"
                                    class="text-black border border-gray-300 mr-1 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center"
                                >
                                    Обновить пост
                                </button>
                                <a
                                    href="{{ route('posts.index') }}"
                                    class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5"
                                >
                                    Отмена
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
