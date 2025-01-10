<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $user->name }}'s Profile
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h3 class="text-2xl font-semibold">{{ $user->name }}</h3>
                    {{-- <p class="mt-2 text-gray-700">Email: {{ $user->email }}</p> --}}
                    <p class="mt-2 text-gray-700">Birthday: {{ $user->birthday ? $user->birthday : 'Not provided' }}</p>
                    <p class="mt-2 text-gray-700">About: {{ $user->about }}</p>

                    <!-- Display profile picture if available -->
                    @if ($user->profilePicture)
                        <img src="{{ asset('storage/profile_pictures/' . $user->profilePicture->filename) }}" alt="Profile Picture" class="rounded-full w-32 h-32">
                    @else
                        <p class="mt-2 text-gray-700">No profile picture available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
