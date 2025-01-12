<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Admin FAQ</h1>
        <h1 class="text-lg mb-4 text-gray-700">Manage FAQs on the admin side</h1>

        <!-- Add FAQ Button -->
        <a href="{{ route('faq.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded mb-6 inline-block" style="color: black;">
            <i class="fas fa-plus mr-2"></i> Add FAQ
        </a>

        <!-- Add Category Button -->
        <a href="{{ route('category.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded mb-6 inline-block" style="color: black;">
            <i class="fas fa-plus-circle mr-2"></i> Add Category
        </a>

        <div class="space-y-6">
            @foreach ($faqs as $faq)
                <div class="border rounded-lg shadow-md p-4 bg-white">
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $faq->question }}</h3>
                    <p class="text-gray-600">{{ $faq->answer }}</p>
                    <div class="mt-4 flex space-x-4">
                        <a href="{{ route('faq.edit', $faq) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-1 px-3 rounded flex items-center" style="color: black;">
                            <i class="fas fa-edit mr-2"></i>Edit
                        </a>
                        <form action="{{ route('faq.destroy', $faq) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-1 px-3 rounded flex items-center" style="color: black;">
                                <i class="fas fa-trash mr-2"></i>Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
