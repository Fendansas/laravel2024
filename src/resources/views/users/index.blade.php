<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                            <div class="container">
                                <h1>Список пользователей</h1>

                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Имя</th>
                                        <th>Email</th>
                                        <th>Роли</th>
                                        <th>Дата регистрации</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <a href="{{ route('users.show', $user) }}">
                                                    {{ $user->name }}
                                                </a>
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @foreach($user->getRoleNames() as $role)
                                                    <span class="badge bg-primary">{{ $role }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                                {{ $users->links() }} <!-- Пагинация, если используете -->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
