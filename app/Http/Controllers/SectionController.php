<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogSection;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    /**
     * Display a listing of the blog section resource.
     */
    public function index(Blog $blog)
    {
        //how to pass a specific blog to help filter sections for a blog??
        $sections = $blog->sections()->orderBy("id", "desc")->paginate(10);
        return view('user.blogsections', compact('blog', 'sections'));
    }

    /**
     * Show the form for creating a new blog section resource.
     */
    public function create(Blog $blog)
    {
        //Use of the compact function to create an array of the parameters given
        //pass the array to the view
        return view('user.create-section', compact('blog'));
    }

    /**
     * Store a newly created blog section resource in storage.
     */
    public function store(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'heading' => 'required|string|max:500',
            'content' => 'required|string|max:2500',
            'section_image' => 'nullable|string',
        ]);

        $blog->sections()->create($validated);
        return redirect()->route('sections-index', $blog)->with('success', 'Section Created!');
    }

    /**
     * Display the specified blog section resource.
     */
    public function show(Blog $blog, BlogSection $section)
    {
        //Use of the compact function to create an array of the parameters given
        //pass the array to the view
        //dd($section);
        return view('user.section', compact('blog', 'section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
