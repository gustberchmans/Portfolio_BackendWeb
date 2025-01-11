<!-- resources/views/news_feed/create.blade.php -->

<x-app-layout>
    <div class="container mx-auto mt-8">
        <!-- Page Header -->
        <h1 class="text-2xl font-bold mb-6 text-center">Add New News Feed</h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- News Feed Creation Form -->
        <form method="POST" action="{{ route('news_feed.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Title Field -->
            <div>
                <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" id="title" name="title" class="mt-1 block w-full min-w-[100px] px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Content Field -->
            <div>
                <label for="content" class="block text-sm font-medium text-gray-700">Content</label>
                <textarea id="content" name="content" class="mt-1 block w-full min-w-[100px] px-4 py-2 border border-gray-300 rounded-md" rows="5" required></textarea>
            </div>

            <!-- Date Field -->
            <div>
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" id="date" name="date" value="{{ \Carbon\Carbon::today()->toDateString() }}" class="mt-1 block w-full min-w-[100px] px-4 py-2 border border-gray-300 rounded-md" required>
            </div>

            <!-- Image Upload -->
            <div>
                <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                <input type="file" id="image" name="image" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none">
                    Add News Feed
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
