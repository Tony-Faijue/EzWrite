<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'hero_title' => 'required|string|255',
            'intro' => 'required|string|500',
            'hero_topics' => 'nullable|array|max:10',
            'hero_topics.*' => 'required|string|max:255',
            'hero_authors' => 'nullable|array|max:5',
            'hero_authors.*' => 'required|string|max:255',
            'hero_image' => 'nullable|string',
            'footer_about' => 'nullable|string',
        ]);
        //$request->user() returns the currently authenticated user
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
