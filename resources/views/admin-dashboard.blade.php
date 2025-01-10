<!-- resources/views/admin-dashboard.blade.php -->
<x-app-layout>
    <div class="container text-center mt-5">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>You have administrative privileges!</p>
        <div>
            <a href="{{ route('users.index') }}" class="px-4 py-2 bg-green-500 text-black rounded">View All Users</a>
        </div>
    </div>
</x-app-layout>
