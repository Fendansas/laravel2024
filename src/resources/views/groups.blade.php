<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Groups') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <ul>
                        @foreach($groups as $group)
                            <div class="border-1 border-r-2 m-2">
                                <li>
                                    <span>{{$group['id']}} </span>
                                    <a href="/groups/{{$group['id']}}"><strong>{{$group['title']}}:</strong> Pays {{$group['salary']}}</a> </li>
                                <div>
                                    {{$group->post->name}}
                                </div>
                            </div>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
