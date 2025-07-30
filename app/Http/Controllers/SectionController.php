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
        //Use of the compact function to create an array of the parameters given for the blog
        //pass the array to the view
        return view('user.create-section', compact('blog'));
    }

    /**
     * Store a newly created blog section resource in storage.
     */
    public function store(Request $request, Blog $blog)
    {
        //Create 2 fields file and url for image to be validated
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
        return redirect()->route('sections-index', $blog)->with('Success', 'Section Created!');
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
     * Show the form for editing the specified blog section.
     */
    public function edit(Blog $blog, BlogSection $section)
    {
        //Use of the compact function to create an array of the parameters given for the blog
        //pass the array to the view
        return view('user.update-section', compact('blog', 'section'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog, BlogSection $section)
    {
        //dd($request->all(), $request->files->all());
        //Validate the inputs
        $validated = $request->validate([
            'heading' => 'required|string|max:500',
            'content' => 'required|string|max:2500',
            'section_image_url' => 'nullable|url|max:8192',
            'section_image_file' => 'nullable|image|max:8192',
        ]);
        //Set default image value to already stored image
        $pathOrUrl = $section->section_image;

        if ($request->hasFile('section_image_file')) {
            //Delete old file from storage if was uploaded locally
            if ($section->section_image && !str_starts_with($section->section_image, 'http')) {
                //Go to disk in public storage folder and delete corresponding image
                Storage::disk('public')->delete($section->section_image);
            }
            //Store the image file in the public folder on the disk
            $pathOrUrl = $request->file('section_image_file')->store('sections', 'public');
        }
        //Otherwise, use the url if provided
        elseif (!empty($validated['section_image_url'])) {
            $pathOrUrl = $validated['section_image_url'];
        }

        //Update the section
        $section->update([
            'heading' => $validated['heading'],
            'content' => $validated['content'],
            'section_image' => $pathOrUrl //can still be null, path or url
        ]);

        return redirect()->route('sections-index', $blog)->with('Success', 'Section Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog, BlogSection $section)
    {
        //delete the section
        $section->delete();
        //redirect
        return redirect()->route('sections-index', $blog)->with('Success', 'Section Deleted Successfully');
    }

    /**
     * Return the delete section confirmation page
     * @param \App\Models\Blog $blog
     * @param \App\Models\BlogSection $section
     * @return \Illuminate\Contracts\View\View
     */
    public function confirmDelete(Blog $blog, BlogSection $section)
    {
        return view('user.delete-section-confirm', compact('blog', 'section'));
    }

}
