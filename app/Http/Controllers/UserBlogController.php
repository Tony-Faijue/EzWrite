<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = auth()->user()->blogs()->orderBy("created_at", "desc")->paginate(10);
        return view('user.blogs', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create-blog');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Validation on the request
        //* is wildcard for arrays validate individual items in the array
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'intro' => 'required|string|max:500',
            'hero_topics' => 'nullable|array|max:10',
            'hero_topics.*' => 'nullable|string|max:255',
            'hero_authors' => 'nullable|array|max:5',
            'hero_authors.*' => 'nullable|string|max:255',
            'hero_image' => 'nullable|string',
            'footer_about' => 'nullable|string|max:500',
        ]);

        // Drop blank/whitespace entries of authors and topics
        // Re index them 
        $cleanAuthors = array_filter($validated['hero_authors'] ?? [], fn($author) => trim($author) !== '');
        $validated['hero_authors'] = array_values($cleanAuthors);

        $cleanTopics = array_filter($validated['hero_topics'] ?? [], fn($topic) => trim($topic) !== '');
        $validated['hero_topics'] = array_values($cleanTopics);



        //$request->user() returns the currently authenticated user
        //automatically assign user_id of the blog
        $request->user()->blogs()->create($validated);
        return redirect()->route('blogs-index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
