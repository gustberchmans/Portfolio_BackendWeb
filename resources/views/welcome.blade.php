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
        <div class="container text-center mt-5">
            <h1>Welcome to the Application</h1>
            <p>Please choose an option below:</p>
            <div>
                <a href="{{ route('login') }}" class="btn btn-primary me-2">Login</a>
                <a href="{{ route('register') }}" class="btn btn-success">Register</a>
            </div>
        </div>
    </div>
</x-app-layout>
