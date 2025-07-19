<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of blog resources
     */
    public function index()
    {
        $blogs = Blog::orderBy("created_at", "desc")->paginate(10);
        return view('blogs.index', ['blogs' => $blogs]);
    }

    /**
     * Display the specified blog resource.
     */
    public function show(string $id)
    {
        //
    }

}
