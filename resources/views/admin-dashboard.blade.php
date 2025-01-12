<x-app-layout>
    <div class="container mt-5">
        <div class="mt-4">
            <a href="{{ route('users.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition duration-200" style="background: rgb(59, 59, 208); height: 60px; width: 200px;">
                View All Users
            </a>
        </div>

        <!-- Button to view News Feed -->
        <div class="mt-4">
            <a href="{{ route('news_feed.news-feed') }}" class="inline-block px-6 py-3 bg-green-600 text-white rounded-lg shadow-md hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 transition duration-200" style="background: rgb(29, 201, 56); height: 60px; width: 200px;">
                View News Feed
            </a>
        </div>
    </div>
</x-app-layout>
