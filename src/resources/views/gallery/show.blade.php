<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $image->title ?? 'Image' }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mt-5">
                        <div class="card-body text-center">
                            <img src="{{ asset($image->path) }}" class="img-fluid" alt="{{ $image->title }}" style="max-height: 70vh;">
                            @if($image->description)
                                <div class="mt-3">
                                    <p>{{ $image->description }}</p>
                                </div>
                            @endif

                            <div class="mt-3">
                                <a href="{{ route('gallery.index', $image->user) }}" class="btn btn-secondary">Back to Gallery</a>
                            </div>
                            <div class="mt-3">
                                @auth
                                    @if(auth()->id() === $image->user_id)
                                        <form action="{{ route('gallery.destroy', $image) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Are you sure you want to delete this image?')">
                                                Delete Image
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>

    document.addEventListener('DOMContentLoaded', function () {
        const deleteForms = document.querySelectorAll('form[action*="gallery.destroy"]');

        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                if (!confirm('Are you sure you want to delete this image?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
