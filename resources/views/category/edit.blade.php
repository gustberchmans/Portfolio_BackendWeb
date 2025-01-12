<x-app-layout>
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold mb-6">Edit Category</h1>

        <form action="{{ route('category.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="name" class="block text-lg font-semibold mb-2">Category Name</label>
                <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-md" value="{{ $category->name }}" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                Update Category
            </button>
        </form>
    </div>
</x-app-layout>
