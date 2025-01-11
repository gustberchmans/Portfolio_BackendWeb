<!-- resources/views/admin-dashboard.blade.php -->
<x-app-layout>
    <div class="container text-center mt-5">
        <h1>Welcome to the Admin Dashboard</h1>
        <p>You have administrative privileges!</p>
        <div class="mt-4">
            <a href="{{ route('users.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg shadow-md hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-300 transition duration-200" style="background: rgb(59, 59, 208); height: 60px; width: 200px;">
                View All Users
            </a>
        </div>
    </div>
</x-app-layout>
