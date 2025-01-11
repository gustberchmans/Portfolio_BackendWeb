<x-app-layout>
    <div class="container mx-auto mt-8">
        @if(session('error'))
            <div class="bg-red-500 text-white p-4 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr>
                    <th class="border border-gray-300 px-4 py-2">Name</th>
                    <th class="border border-gray-300 px-4 py-2">Email</th>
                    <th class="border border-gray-300 px-4 py-2">Admin</th>
                    <th class="border border-gray-300 px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $user->isAdmin ? 'Yes' : 'No' }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            <form method="POST" action="{{ route('users.toggleAdmin', $user) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="px-4 py-2 bg-blue-500 rounded text-white" style="color: blue">
                                    {{ $user->isAdmin ? 'Remove Admin' : 'Make Admin' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-app-layout>
