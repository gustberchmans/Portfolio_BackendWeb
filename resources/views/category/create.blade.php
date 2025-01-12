<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Add New Category</h1>

        <form action="{{ route('category.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold mb-2">Category Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Save Category
            </button>
        </form>

        <h2 class="text-2xl font-bold mt-6">Existing Categories</h2>
        <div class="mt-4">
            @foreach($categories as $category)
                <div class="flex justify-between items-center border-b py-2">
                    <span class="text-lg">{{ $category->name }}</span>
                    <div class="flex space-x-4">
                        <!-- Edit Button -->
                        <a href="{{ route('category.edit', $category) }}" class="text-yellow-500 hover:text-yellow-600">
                            <i class="fas fa-edit"></i> Edit
                        </a>

                        <!-- Delete Button -->
                        <form action="{{ route('category.destroy', $category) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600">
                                <i class="fas fa-trash"></i> Delete
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
