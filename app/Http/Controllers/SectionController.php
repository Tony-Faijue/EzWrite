<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogSection;
use Illuminate\Http\Request;
use Storage;

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
        //Create 2 fields file and url for image to be validates
        $validated = $request->validate([
            'heading' => 'required|string|max:500',
            'content' => 'required|string|max:2500',
            'section_image_file' => 'nullable|image|max:8192',
            'section_image_url' => 'nullable|url|max:8192',
        ]);

        //file path or url will be assigned to this value or remain null
        $pathOrUrl = null;

        //If image is uploaded store the image first
        if ($request->hasFile('section_image_file')) {
            //sections folder under storage/app/public
            //public is the disk name
            $pathOrUrl = $request->file('section_image_file')->store('sections', 'public');
        }
        //Otherwise, use the url if provided
        elseif (!empty($validated['section_image_url'])) {
            $pathOrUrl = $validated['section_image_url'];
        }

        //Merge the chosen path/URL back into the data array
        $data = [
            'heading' => $validated['heading'],
            'content' => $validated['content'],
            'section_image' => $pathOrUrl,  //null, path, or external url
        ];

        $blog->sections()->create($data);
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
