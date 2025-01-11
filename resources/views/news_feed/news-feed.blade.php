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
                <div class="mb-4">
                    <h3 class="text-xl font-bold">{{ $news->title }}</h3>
                    <p class="text-gray-700">{{ $news->content }}</p>
                    <p class="text-sm text-gray-500">{{ $news->date }}</p>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
