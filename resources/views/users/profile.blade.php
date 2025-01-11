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
                        {{-- <p class="mt-2 text-gray-700">Email: {{ $user->email }}</p> --}}
                        <p class="mt-2 text-gray-700">Birthday: {{ $user->birthday ? $user->birthday : 'Not provided' }}</p>
                        <p class="mt-2 text-gray-700">About: {{ $user->about }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
