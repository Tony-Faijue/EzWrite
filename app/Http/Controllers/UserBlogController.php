<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    /**
     * Display a listing of the user blog resource.
     */
    public function index()
    {
        $blogs = auth()->user()->blogs()->orderBy("created_at", "desc")->paginate(10);
        return view('user.blogs', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new user blog resource.
     */
    public function create()
    {
        return view('user.create-blog');
    }

    /**
     * Store a newly created user blog resource in storage.
     */
    public function store(Request $request)
    {
        //Validation on the request by applying requirements
        //* is wildcard for arrays which validates individual items in the array
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

        //Drop blank/whitespace entries of authors and topics
        //Use of the array_fileter to method filter array items with the callback function
        //Use of the null coalescing operator; $validated['hero_authors'] ?? [] ensures that array is used even if the field is null
        //Use of PHP's short arrow function
        //Check if the trimmed result is not an empty string
        //array_filter keeps only items where the callback function returns true
        //array_values reindexes the array numerically
        $cleanAuthors = array_filter($validated['hero_authors'] ?? [], fn($author) => trim($author) !== '');
        $validated['hero_authors'] = array_values($cleanAuthors);

        $cleanTopics = array_filter($validated['hero_topics'] ?? [], fn($topic) => trim($topic) !== '');
        $validated['hero_topics'] = array_values($cleanTopics);



        //$request->user() returns the currently authenticated/logged-in user
        //automatically assign user_id of the blog and redirect
        $request->user()->blogs()->create($validated);
        return redirect()->route('blogs-index');

    }

    /**
     * Display the specified user blog resource.
     */
    public function show(Blog $blog)
    {   //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {   //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(404);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): void
    {   //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(404);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {   //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(404);
        }

    }
}
