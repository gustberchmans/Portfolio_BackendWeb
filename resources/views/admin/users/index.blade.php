@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gebruikers Beheren</h1>

    <table>
        <thead>
            <tr>
                <th>Naam</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acties</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <!-- Promote to Admin Form -->
                    @if ($user->role !== 'admin')
                    <form action="{{ route('admin.promote', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Promoveer tot Admin</button>
                    </form>
                    @endif

                    <!-- Demote to User Form -->
                    @if ($user->role === 'admin')
                    <form action="{{ route('admin.demote', $user->id) }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit">Degradeer tot Gebruiker</button>
                    </form>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
