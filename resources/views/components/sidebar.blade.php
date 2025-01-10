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
        {{ $users->links() }}
    </div>
</div>
