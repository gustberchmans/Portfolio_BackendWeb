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
        <div class="flex-1" style="margin-left: 10px">
            <h3 class="text-xl font-semibold mb-4">Welcome to the Dashboard</h3>
            <p>Manage your users and their details here.</p>
        </div>
    </div>
</x-app-layout>
