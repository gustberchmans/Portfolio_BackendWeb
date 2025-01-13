<x-app-layout>
    <h1>Contact Messages</h1>

    @foreach ($contacts as $contact)
        <div class="contact-card">
            <p><strong>Name:</strong> {{ $contact->name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            <p><strong>Message:</strong> {{ $contact->message }}</p>

            <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                @csrf
                <textarea name="reply_message" rows="3" placeholder="Type your reply here" required></textarea>
                <button type="submit">Send Reply</button>
            </form>
        </div>
    @endforeach
</x-app-layout>
