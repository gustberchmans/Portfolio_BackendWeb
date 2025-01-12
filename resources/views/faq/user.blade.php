<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">User FAQ</h1>

        @foreach($categories as $category)
            <h2 class="text-2xl font-semibold mb-4">{{ $category->name }}</h2>

            <div class="space-y-6">
                @foreach ($faqs->where('category_id', $category->id) as $faq)
                    <div class="border rounded-lg shadow-md p-4 bg-white">
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $faq->question }}</h3>
                        <p class="text-gray-600">{{ $faq->answer }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</x-app-layout>
