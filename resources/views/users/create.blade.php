<x-app-layout>
    <div class="container mx-auto mt-8 flex justify-center">
        <div class="w-full max-w-md">
            <!-- Page Header -->
            <h1 class="text-2xl font-bold mb-6 text-center">Add New User</h1>

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

            <!-- User Creation Form -->
            <form method="POST" action="{{ route('users.store') }}" class="space-y-4">
                @csrf

                <!-- Name Field -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="mt-1 block w-full min-w-[100px] px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" class="mt-1 block w-full min-w-[100px] px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" class="mt-1 block w-full min-w-[100px] px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Confirm Password Field -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" class="mt-1 block w-full min-w-[100px] px-4 py-2 border border-gray-300 rounded-md" required>
                </div>

                <!-- Is Admin Checkbox -->
                <div>
                    <label for="isAdmin" class="block text-sm font-medium text-gray-700">Make Admin</label>
                    <input type="checkbox" id="isAdmin" name="isAdmin" class="mt-1">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none" style="border: 1px solid black;">
                        Add User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
