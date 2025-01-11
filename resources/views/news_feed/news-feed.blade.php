<x-app-layout>
    <div class="container mt-5">
        <!-- Button to create a new news article -->
        <div class="mt-4">
            <a href="{{ route('news-feed.create') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 transition duration-200" style="background: rgb(29, 201, 56); height: 60px; width: 200px;">
                Create News Article
            </a>
        </div>

        <div class="bg-white p-4 rounded-md shadow-md">
            <h2 class="text-xl font-semibold mb-4">Latest News</h2>

            @foreach ($newsFeed as $news)
                <div class="flex justify-between items-start mb-4">
                    <div class="flex flex-col flex-1">
                        <h3 class="text-xl font-bold">{{ $news->title }}</h3>
                        <p class="text-gray-700">{{ $news->content }}</p>
                        <p class="text-sm text-gray-500">{{ $news->date }}</p>
                    </div>

                    <!-- Buttons (Edit, Delete) on the Right side -->
                    <div class="flex flex-col items-end space-y-2">
                        <!-- Edit Button with Icon -->
                        <a href="{{ route('news-feed.edit', ['news' => $news->id]) }}" class="inline-block text-blue-500 hover:text-blue-700">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <!-- Trash Icon for Deleting the News Article -->
                        <form action="{{ route('news-feed.destroy', $news) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-700">
                                <i class="fas fa-trash-alt"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
