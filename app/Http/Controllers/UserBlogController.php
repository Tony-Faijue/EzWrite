<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Log;
use Storage;
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
        // dd($request->all(), $request->files->all());

        //Validation on the request by applying requirements
        //* is wildcard for arrays which validates individual items in the array
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'intro' => 'required|string|max:500',
            'is_public' => 'required|boolean',
            'hero_topics' => 'nullable|array|max:10',
            'hero_topics.*' => 'nullable|string|max:255',
            'hero_authors' => 'nullable|array|max:5',
            'hero_authors.*' => 'nullable|string|max:255',
            'hero_image_url' => 'nullable|url|max:8192',
            'hero_image_file' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:8192',
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

        //file path or url will be assigned to this value or remain null
        $pathOrUrl = null;

        //If image is uploaded store the image first
        if ($request->hasFile('hero_image_file')) {
            try {
                //heroimages folder under storage/app/public
                $pathOrUrl = $request->file('hero_image_file')->store('heroimages', 'public');
                Log::info('Stored at:', ['path' => $pathOrUrl, 'exists?' => Storage::disk('public')->exists($pathOrUrl)]);

                if (!Storage::disk('public')->exists($pathOrUrl)) {
                    throw new Exception('File was not stored properly');
                }
            } catch (Exception $e) {
                Log::error('Hero image upload failed:', ['error' => $e->getMessage()]);
            }

        }
        //Otherwise, use the url if provided
        elseif (!empty($validated['hero_image_url'])) {
            $pathOrUrl = $validated['hero_image_url'];
            Log::info('Using hero image URL:', ['url' => $pathOrUrl]);
        }

        //Merge the choosen path/URL 
        $data = [
            'hero_title' => $validated['hero_title'],
            'intro' => $validated['intro'],
            'is_public' => $validated['is_public'],
            'hero_topics' => $validated['hero_topics'],
            'hero_authors' => $validated['hero_authors'],
            'hero_image' => $pathOrUrl, //null, path, or external url
            'footer_about' => $validated['footer_about'],
        ];

        //$request->user() returns the currently authenticated/logged-in user
        //automatically assign user_id of the blog and redirect
        $request->user()->blogs()->create($data);
        return redirect()->route('user-blogs-index')->with('Success', 'Blog Successfully Created!');
    }

    /**
     * Display the specified user blog resource.
     */
    public function show(Blog $blog)
    {
        //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(404);
        }

        //Sections of the blog
        $sections = $blog->sections()->orderBy('created_at', 'desc')->get();

        return view('user.blog', compact('blog', 'sections'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {   //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(404);
        }

        return view('user.update-blog', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog): RedirectResponse
    {   //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(404);
        }
        //dd($request->all(), $request->files->all());

        //Validate the inputs
        $validated = $request->validate([
            'hero_title' => 'required|string|max:255',
            'intro' => 'required|string|max:500',
            'is_public' => 'required|boolean',
            'hero_topics' => 'nullable|array|max:10',
            'hero_topics.*' => 'nullable|string|max:255',
            'hero_authors' => 'nullable|array|max:5',
            'hero_authors.*' => 'nullable|string|max:255',
            'hero_image_url' => 'nullable|url|max:8192',
            'hero_image_file' => 'nullable|mimes:jpeg,jpg,png,gif,bmp,webp|max:8192',
            'footer_about' => 'nullable|string|max:500',
        ]);

        //Check to see if blog has at least one section before making public
        $isPublic = $validated['is_public'];
        if ($isPublic && $blog->sections()->count() === 0) {
            return back()->withErrors(['is_public' => 'Blog needs at least one section before it can become public'])->withInput();
        }

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

        //Set default image value to already stored image
        $pathOrUrl = $blog->hero_image;

        if ($request->hasFile('hero_image_file')) {
            //Delete old file from storage if was uploaded locally
            if ($blog->hero_image && !str_starts_with($blog->hero_image, 'http')) {
                //Go to disk in public sotrage folder and delete corresponding image
                Storage::disk('public')->delete($blog->hero_image);
            }
            //Store the image file in the public folder on the disk
            $pathOrUrl = $request->file('hero_image_file')->store('heroimages', 'public');
        }
        //Otherwise, use the url if provided
        elseif (!empty($validated['hero_image_url'])) {
            $pathOrUrl = $validated['hero_image_url'];
        }

        //Update the blog
        $blog->update([
            'hero_title' => $validated['hero_title'],
            'intro' => $validated['intro'],
            'is_public' => $validated['is_public'],
            'hero_topics' => $validated['hero_topics'],
            'hero_authors' => $validated['hero_authors'],
            'hero_image' => $pathOrUrl,
            'footer_about' => $validated['footer_about'],
        ]);

        return redirect()->route('user-blogs-index')->with('Success', "Blog Updated Successfully!");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Blog $blog)
    {   //Handle Access by other users
        if ($blog->user_id != auth()->id()) {
            abort(403);
        }

        //delete the blog model
        $blog->delete();
        return redirect()->route('user-blogs-index')->with('Success', 'Blog Successfully Deleted!');
    }

    public function confirmDelete(Blog $blog)
    {
        if ($blog->user_id != auth()->id()) {
            abort(403);
        }
        return view('user.delete-blog-confirm', compact('blog'));
    }
}
