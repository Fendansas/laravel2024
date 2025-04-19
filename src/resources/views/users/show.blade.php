<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($user->name) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="card">
                                        <div class="card-header">
                                            <h2>Профиль пользователя: {{ $user->name }}</h2>
                                        </div>
                                        <div class="card-body">
                                            <p><strong>ID:</strong> {{ $user->id }}</p>
                                            <p><strong>Email:</strong> {{ $user->email }}</p>
                                            <p><strong>Зарегистрирован:</strong> {{ $user->created_at->format('d.m.Y H:i') }}</p>

                                            <h4>Роли:</h4>
                                            <div>
                                                @foreach($user->getRoleNames() as $role)
                                                    <span class="badge bg-primary">{{ $role }}</span>
                                                @endforeach
                                            </div>

                                            @if($user->posts->count())
                                                <h4 class="mt-4">Посты пользователя:</h4>
                                                <ul>
                                                    @foreach($user->posts as $post)
                                                        <li>
                                                            <a href="{{ route('posts.show', $post) }}">
                                                                {{ $post->title }}
                                                            </a>
                                                            ({{ $post->created_at->format('d.m.Y') }})
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">
                                Вернуться к списку пользователей
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
