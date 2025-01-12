<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Contact Us</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold mb-2">Your Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="email" class="block text-lg font-semibold mb-2">Your Email</label>
                <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-md" required>
            </div>

            <div class="mb-4">
                <label for="message" class="block text-lg font-semibold mb-2">Your Message</label>
                <textarea id="message" name="message" class="w-full px-4 py-2 border rounded-md" required></textarea>
            </div>

            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Send Message
            </button>
        </form>
    </div>
</x-app-layout>
