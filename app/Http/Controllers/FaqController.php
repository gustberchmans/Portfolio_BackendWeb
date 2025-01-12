<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\Category;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the FAQs.
     */
    public function index()
    {
        $faqs = Faq::all(); // Fetch FAQs for general users or guests
        $categories = Category::all();
        return view('faq.user', compact('faqs', 'categories'));
    }

    public function admin()
    {
        $faqs = Faq::all(); // Fetch FAQs for admins
        $categories = Category::all();
        return view('faq.admin', compact('faqs', 'categories'));
    }

    /**
     * Show the form for creating a new FAQ.
     */
    public function create()
    {
        $categories = Category::all();  // Fetch categories
        return view('faq.create', compact('categories'));
    }

    /**
     * Store a newly created FAQ in the database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category_id' => 'required|exists:categories,id',  // Ensure category_id exists
        ]);

        Faq::create($request->all());

        return redirect()->route('faq.admin');
    }

    public function edit(Faq $faq)
    {
        $categories = Category::all();  // Fetch categories
        return view('faq.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $request->validate([
            'question' => 'required|string',
            'answer' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $faq->update($request->all());

        return redirect()->route('faq.admin');
    }

    /**
     * Remove an FAQ from the database.
     */
    public function destroy(Faq $faq)
    {
        $faq->delete();

        return redirect()->route('faq.admin')->with('success', 'FAQ deleted successfully!');
    }
}
