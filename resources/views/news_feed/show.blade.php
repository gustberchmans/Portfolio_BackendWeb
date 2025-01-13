<x-app-layout>
    <div class="container mt-5">
        <h1 class="font-bold text-3xl">{{ $news->title }}</h1>
        <p class="text-sm text-gray-600">{{ $news->date }}</p>
        <p class="mt-4">{{ $news->content }}</p>

        @if ($news->picture)
            <div class="mt-4">
                <img src="data:image/{{ $news->picture->file_type }};base64,{{ base64_encode($news->picture->file_data) }}" alt="Article Image" class="rounded-md w-full" style="height: 200px; width: auto;" />
            </div>
        @endif

        <!-- Comment Section -->
        <div class="mt-8">
            <h2 class="font-bold text-xl mb-4">Comments</h2>

            <!-- Display Comments -->
            @foreach ($news->comments as $comment)
                <div class="mb-4 p-4 border rounded-md">
                    <p class="font-semibold">{{ $comment->author }}</p>
                    <p class="text-gray-600 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                    <p class="mt-2">{{ $comment->content }}</p>
                </div>
            @endforeach

            <!-- Add a Comment -->
            <form action="{{ route('news.comments.store', $news) }}" method="POST" class="mt-6">
                @csrf
                <div class="mb-4">
                    <label for="author" class="block text-sm font-medium">Your Name</label>
                    <input type="text" name="author" id="author" class="w-full border-gray-300 rounded-md shadow-sm" required>
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium">Your Comment</label>
                    <textarea name="content" id="content" rows="4" class="w-full border-gray-300 rounded-md shadow-sm" required></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                    Submit Comment
                </button>
            </form>
        </div>
    </div>
</x-app-layout>

