@extends('layouts.layout')

@push('scripts')
    <script src="{{ asset('js/blog-form.js') }}"></script>
@endpush



@section('content')
    <div class="bg-grad-2 flex">
        <!-- Error Handling -->
        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-user.side-nav />
        <div class="user-form-bg mx-auto mt-10 mb-10">
            <form action="{{ route('user-blogs-store') }}" method="POST">
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
                        <p class="text-center text-lg">Can add up to 5 additional authors</p>
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
                                        class="remove-author px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700 ">Remove
                                        Author</button>
                                </div>
                            @endforeach
                        </div>
                        <!-- Template for new Author rows -->
                        <template id="author-row-template">
                            <div class="author-row">
                                <input type="text" name="hero_authors[]"
                                    class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                    placeholder="Author Name" />
                                <button type="button"
                                    class="remove-author px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700">Remove
                                    Author</button>
                            </div>
                        </template>
                        <button type="button" id="add-author"
                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-blue-700 disabled:opacity-50">Add
                            Author</button>

                        <!-- Dynamic Topics -->
                        <label class="text-2xl text-center">Topics</label>
                        <p class="text-center text-lg">Can add up to 10 topics</p>
                        <div id="topics-wrapper">
                            @php
                                $topics = old('hero_topics', ['']);
                            @endphp

                            @foreach($topics as $topic)
                                <div class="topic-row">
                                    <input type="text" name="hero_topics[]" value="{{$topic}}"
                                        class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                        placeholder="Topic" />
                                    <button type="button"
                                        class="remove-topic px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700 ">Remove
                                        Topic</button>
                                </div>
                            @endforeach
                        </div>
                        <!-- Template for new Topic rows -->
                        <template id="topic-row-template">
                            <div class="topic-row">
                                <input type="text" name="hero_topics[]"
                                    class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                    placeholder="Topic" />
                                <button type="button"
                                    class="remove-topic px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700">Remove
                                    Topic</button>
                            </div>
                        </template>
                        <button type="button" id="add-topic"
                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-blue-700 disabled:opacity-50">Add
                            Topic</button>

                        <!-- Footer-->
                        <label for="footer_about" class="text-2xl">Footer</label>
                        <textarea id="footer_about" name="footer_about"
                            class="h-30 pl-4 pr-4 text-lg input-blog-form input-blog-form-focus"
                            placeholder="Describe Yourself and Your Relationship with Topic" required></textarea>
                        <div class="flex justify-center">
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection