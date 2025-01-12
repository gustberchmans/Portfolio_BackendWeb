{{-- // resources/views/faq/edit.blade.php --}}
<x-app-layout>
    <form action="{{ route('faq.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="question">Question:</label>
        <input type="text" name="question" id="question" value="{{ $faq->question }}" class="form-input" required>

        <label for="answer">Answer:</label>
        <textarea name="answer" id="answer" class="form-textarea" required>{{ $faq->answer }}</textarea>

        <label for="category">Category:</label>
        <select name="category_id" id="category" class="form-select" required>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $faq->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="bg-blue-500 text-white">Update FAQ</button>
    </form>
</x-app-layout>
