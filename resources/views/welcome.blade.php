<x-app-layout>
    <div class="flex space-x-6">
        <!-- Sidebar -->
        <div class="bg-gray-800 text-white w-64 min-h-screen p-4">
            <h2 class="text-xl font-semibold">Users List</h2>

            <ul class="space-y-2 mt-4">
                @foreach ($users as $user)
                    <li>
                        <a href="{{ route('users.show', $user->id) }}" class="block p-2 rounded hover:bg-gray-700">
                            {{ $user->name }}
                        </a>
                    </li>
                @endforeach
            </ul>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $users->links() }}  <!-- Pagination links to navigate through pages -->
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1" style="margin: 10px">
            <!-- News Feed Section -->
            <div class="bg-white shadow-lg rounded-lg p-6 mb-6">
                <h2 class="text-xl font-semibold mb-4">Latest News</h2>

                @forelse($newsFeed as $news)
                    <div class="border-b border-gray-300 py-4 flex items-center justify-between">
                        <div class="flex-1">
                            <!-- Make the title clickable -->
                            <p class="font-bold text-lg text-blue-600 hover:underline">
                                {{ $news->title }}
                            </p>
                            <p class="text-sm text-gray-600">{{ $news->date }}</p>
                            <p class="mt-2">{{ Str::limit($news->content, 150) }}</p>
                        </div>

                        <!-- Display Image (if exists) -->
                        @if ($news->picture)
                            <div class="ml-4">
                                <img src="data:image/{{ $news->picture->file_type }};base64,{{ base64_encode($news->picture->file_data) }}" alt="Current Image" class="w-32 h-32 rounded-md" style="height: 100px; width: auto">
                            </div>
                        @endif
                    </div>
                @empty
                    <p>No news available.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
