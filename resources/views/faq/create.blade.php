{{-- resources/views/faq/create.blade.php --}}
<x-app-layout>
    <form action="{{ route('faq.store') }}" method="POST">
        @csrf
        <label for="question">Question:</label>
        <input type="text" name="question" id="question" class="form-input" required>

        <label for="answer">Answer:</label>
        <textarea name="answer" id="answer" class="form-textarea" required></textarea>

        <label for="category">Category:</label>
        <select name="category_id" id="category" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white">Create FAQ</button>
    </form>
</x-app-layout>
