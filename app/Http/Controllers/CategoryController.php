<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{

    public function create()
    {
        $categories = Category::all();
        return view('category.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories,name|max:255',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->save();

        return redirect()->route('faq.admin')->with('success', 'Category added successfully!');
    }

    public function edit(Category $category)
    {
        return view('category.edit', compact('category'));
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('category.create')->with('success', 'Category deleted successfully.');
    }

    public function update(Request $request, Category $category)
    {
        // Validate the incoming data
        $request->validate([
            'name' => 'required|string|max:255', // Ensure the category name is provided
        ]);

        // Update the category with the new name
        $category->name = $request->input('name');
        $category->save();

        // Redirect back to the category creation page with a success message
        return redirect()->route('category.create')->with('success', 'Category updated successfully.');
    }
}
