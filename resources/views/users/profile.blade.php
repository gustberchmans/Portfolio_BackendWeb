<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl flex items-start space-x-4">
                    <!-- Profile Picture -->
                    <div style="display: flex; align-items: center; margin-right: 32px">
                        @if ($user->profilePicture && $user->profilePicture->file_data)
                            <img
                                src="data:{{ $user->profilePicture->file_type }};base64,{{ base64_encode($user->profilePicture->file_data) }}"
                                alt="Profile Picture"
                                class="w-32 h-32 rounded-full"
                                style="height: 88px; width: 88px;"
                            />
                        @endif
                    </div>

                    <!-- User Info -->
                    <div class="flex-1">
                        <h3 class="text-2xl font-semibold">{{ $user->name }}</h3>
                        <p class="mt-2 text-gray-700">Birthday: {{ $user->birthday ? $user->birthday : 'Not provided' }}</p>
                        <p class="mt-2 text-gray-700">About: {{ $user->about }}</p>
                    </div>
                </div>
            </div>

            <!-- Comments Section -->
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <h2 class="text-2xl font-semibold mb-4">Comments</h2>

                <!-- Display Comments -->
                @foreach ($user->comments as $comment)
                    <div class="mb-4 p-4 border rounded-md">
                        <p class="font-semibold">{{ $comment->author }}</p>
                        <p class="text-gray-600 text-sm">{{ $comment->created_at->diffForHumans() }}</p>
                        <p class="mt-2">{{ $comment->content }}</p>
                    </div>
                @endforeach

                <!-- Comment Form -->
                <form method="POST" action="{{ route('user.comments.store', $user->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="author" class="block text-gray-700">Your Name</label>
                        <input type="text" name="author" id="author" class="mt-1 block w-full" required>
                    </div>

                    <div class="mb-4">
                        <label for="content" class="block text-gray-700">Your Comment</label>
                        <textarea name="content" id="content" class="mt-1 block w-full" rows="4" required></textarea>
                    </div>

                    <div class="flex justify-end">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Submit Comment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
