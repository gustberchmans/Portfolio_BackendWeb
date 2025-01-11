<x-app-layout>
    <div class="container mt-5">
        <!-- Display any validation errors here -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Edit Form -->
        <form action="{{ route('news-feed.update', $news) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Content -->
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" rows="5" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>{{ old('content', $news->content) }}</textarea>
            </div>

            <!-- Date -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date', $news->date) }}" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Image Upload -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Image (Optional)</label>
                <input type="file" id="image" name="image" accept="image/*" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">

                <!-- Display the current image if available -->
                @if ($news->picture)
                    <div class="mt-2">
                        <img src="data:image/{{ $news->picture->file_type }};base64,{{ base64_encode($news->picture->file_data) }}" alt="Current Image" class="w-32 h-32 rounded-md" style="height: 200px; width: auto">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                Update Article
            </button>
        </form>
    </div>
</x-app-layout>
