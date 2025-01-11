<x-app-layout>
    <div class="container mt-5">
        <h1 class="font-bold text-3xl">{{ $news->title }}</h1>
        <p class="text-sm text-gray-600">{{ $news->date }}</p>
        <p class="mt-4">{{ $news->content }}</p>

        <!-- Display the image if it exists -->
        @if ($news->picture)
            <div class="mt-4">
                <img src="data:image/{{ $news->picture->file_type }};base64,{{ base64_encode($news->picture->file_data) }}" alt="Article Image" class="rounded-md w-full" style="height:  200px; width: auto;"/>
            </div>
        @endif
    </div>
</x-app-layout>
