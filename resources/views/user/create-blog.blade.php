@extends('layouts.layout')

@push('scripts')
    <script src="{{ asset('js/blog-form.js') }}"></script>
@endpush

@section('header')
    <x-user.nav />
@endsection

@section('content')
    <div class="bg-grad-2 flex">
        <x-user.side-nav />
        <div class="user-form-bg mx-auto mt-10 mb-10">
            <form>
                @csrf
                <div class="grid gap-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h2 class="text-4xl text-center">Create a New Blog</h2>
                        <!-- Hero Title -->
                        <label for="hero_title" class="text-2xl">Hero Title</label>
                        <input type="text" id="hero_title" name="hero_title"
                            class="h-15 pl-4 pr-4 input-blog-form input-blog-form-focus" placeholder="Enter the Hero Title"
                            required />
                        <!-- Introduction -->
                        <label for="intro" class="text-2xl">Introduction</label>
                        <textarea id="intro" name="intro"
                            class="h-50 pl-4 pr-4 text-lg input-blog-form input-blog-form-focus"
                            placeholder="Enter your Blog Intro Here" required></textarea>
                        <!-- Hero Image -->
                        <label for="hero_image" class="text-2xl">Hero Image</label>
                        <input type="text" id="hero_image" name="hero_image"
                            class="h-10 pl-4 pr-4 input-blog-form input-blog-form-focus" placeholder="Image URL" />

                        <!-- Dynamic Authors -->
                        <label class="text-2xl text-center">Authors</label>
                        <div id="authors-wrapper">
                            @php
                                $authors = old('hero_authors', ['']);
                            @endphp

                            @foreach($authors as $name)
                                <div class="author-row">
                                    <input type="text" name="hero_authors[]" value="{{$name}}"
                                        class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                        placeholder="Author Name" />
                                    <button type="button"
                                        class="remove-author px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-blue-700 ">Remove
                                        Author</button>
                                </div>
                            @endforeach
                        </div>
                        <!-- Template for new rows -->
                        <template id="author-row-template">
                            <div class="author-row">
                                <input type="text" name="hero_authors[]"
                                    class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                    placeholder="Author Name" />
                                <button type="button"
                                    class="remove-author px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-blue-700">Remove
                                    Author</button>
                            </div>
                        </template>
                        <button type="button" id="add-author"
                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-blue-700">Add Author</button>

                        <!-- Footer-->
                        <label for="footer_about" class="text-2xl">Footer</label>
                        <textarea id="footer_about" name="footer_about"
                            class="h-30 pl-4 pr-4 text-lg input-blog-form input-blog-form-focus"
                            placeholder="Describe Yourself and Your Relationship with Topic"></textarea>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection