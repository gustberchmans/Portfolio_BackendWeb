<x-app-layout>
    <div class="container">
        <h1>Reply to {{ $contact->name }}</h1>
        <p>Email: {{ $contact->email }}</p>
        <p>Message: {{ $contact->message }}</p>

        <form action="{{ route('admin.contacts.sendReply', $contact) }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="response">Your Response</label>
                <textarea name="response" id="response" rows="5" class="form-control" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Send Response</button>
        </form>
    </div>
</x-app-layout>
