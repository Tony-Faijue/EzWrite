@extends('layouts.layout')

<!-- Use of push directive to the value to the name stacked from layout view-->
<!-- Here this view links to js script file related to the form -->
<!-- JS File to handle dynamic add and delete on the form parameters -->
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
        <!-- import user side-nav component -->
        <x-user.side-nav />
        <div class="user-form-bg mx-auto mt-10 mb-10">
            <!-- Form for user to create a blog -->
            <!-- Action calls route for the store function for user blogs   -->
            <form action="{{ route('user-blogs-store') }}" method="POST" enctype="multipart/form-data">
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
                        <h2 class="text-lg">(Optional) Provide an image URL or image file. If both are provided the image
                            file will be used.</h2>
                        <!-- Optional Url Image -->
                        <label for="hero_image_url" class="text-2xl">Hero Image URL</label>
                        <input type="url" id="hero_image_url" name="hero_image_url"
                            class="h-10 pl-4 pr-4 input-blog-form input-blog-form-focus"
                            placeholder="https://example.com/image.jpg" />
                        <!-- Optional File Image -->
                        <label for="hero_image_file" class="text-2xl">Hero Image File</label>
                        <input type="file" id="hero_image_file" name="hero_image_file"
                            class="h-10 pl-4 pr-4 input-blog-form input-blog-form-focus" accept="image/*" />


                        <!-- Dynamic Authors -->
                        <!-- Allows users to add/remove multiple authors within the form  -->
                        <label class="text-2xl text-center">Authors</label>
                        <p class="text-center text-lg">Can add up to 5 additional authors</p>

                        <div id="authors-wrapper">
                            <!-- Use of php directives to execute php code -->
                            <!-- Use of the old function to retrieve old inputs if the form fails/error occurs  -->
                            <!-- No old input defaults to empty array which means one empty row -->
                            @php
                                $authors = old('hero_authors', ['']);
                            @endphp
                            <!-- Loop through exisitng authors -->
                            @foreach($authors as $name)
                                <div class="author-row">
                                    <!-- hero_authors[] ensures PHP treats it as an array  -->
                                    <input type="text" name="hero_authors[]" value="{{$name}}"
                                        class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                        placeholder="Author Name" />
                                    <!-- remove-author button to remove author from the form -->
                                    <button type="button"
                                        class="remove-author px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700 ">Remove
                                        Author</button>
                                </div>
                            @endforeach
                        </div>
                        <!-- Template for new Author rows -->
                        <!-- Use of template tag to hold HTML content that will be cloned with JavaScript -->
                        <!-- Browser does not render it until it is cloned and inserted  -->
                        <template id="author-row-template">
                            <div class="author-row">
                                <!-- Use[] to ensure PHP treats this as an array for validation -->
                                <input type="text" name="hero_authors[]"
                                    class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                    placeholder="Author Name" />
                                <!-- Removes the author row -->
                                <button type="button"
                                    class="remove-author px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700">Remove
                                    Author</button>
                            </div>
                        </template>
                        <!-- Adds a new author row -->
                        <button type="button" id="add-author"
                            class="px-3 py-1 bg-green-600 text-zinc-100 rounded hover:bg-blue-700 disabled:opacity-50">Add
                            Author</button>

                        <!-- Dynamic Topics -->
                        <!-- Allows users to add/remove multiple topics within the form  -->
                        <label class="text-2xl text-center">Topics</label>
                        <p class="text-center text-lg">Can add up to 10 topics</p>
                        <div id="topics-wrapper">
                            <!-- Use of php directives to execute php code -->
                            <!-- Use of the old function to retrieve old inputs if the form fails/error occurs  -->
                            <!-- No old input defaults to empty array which means one empty row -->
                            @php
                                $topics = old('hero_topics', ['']);
                            @endphp
                            <!-- Loop through topics -->
                            @foreach($topics as $topic)
                                <div class="topic-row">
                                    <!-- hero_topics[] ensures PHP treats it as an array  -->
                                    <input type="text" name="hero_topics[]" value="{{$topic}}"
                                        class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                        placeholder="Topic" />
                                    <!-- remove-topic button to remove topic from the form -->
                                    <button type="button"
                                        class="remove-topic px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700 ">Remove
                                        Topic</button>
                                </div>
                            @endforeach
                        </div>
                        <!-- Template for new Topic rows -->
                        <!-- Use of template tag to hold HTML content that will be cloned with JavaScript -->
                        <!-- Browser does not render it until it is cloned and inserted  -->
                        <template id="topic-row-template">
                            <div class="topic-row">
                                <!-- Use[] to ensure PHP treats this as an array for validation -->
                                <input type="text" name="hero_topics[]"
                                    class="h-7 mt-2 mb-2 pl-2 pr-2 input-blog-form input-blog-form-focus"
                                    placeholder="Topic" />
                                <!-- Removes the topic row -->
                                <button type="button"
                                    class="remove-topic px-3 py-1 ml-6 bg-blue-600 text-white rounded hover:bg-red-700">Remove
                                    Topic</button>
                            </div>
                        </template>
                        <!-- Add new topic row -->
                        <button type="button" id="add-topic"
                            class="px-3 py-1 bg-green-600 text-white rounded hover:bg-blue-700 disabled:opacity-50">Add
                            Topic</button>

                        <!-- Public/Private Option -->
                        <div class="flex flex-col gap-2">
                            <p><i class="text-purple-500">Private</i> will be selected first when creating the Blog. To make
                                the Blog <i class="text-purple-500">Public</i> must update the blog after creating at least
                                one section.
                                Then you can update the Blog to <i class="text-purple-500">Public</i>
                                status.</p>
                            <label for="is_public" class="text-2xl">Blog Status</label>
                            <select name="is_public"
                                class="border-2 border-purple-700 rounded-lg block w-full px-4 py-2 text-lg text-purple-500"
                                required>
                                <option value="0">Private</option>
                            </select>
                        </div>
                        <!-- Footer-->
                        <label for="footer_about" class="text-2xl">Footer</label>
                        <textarea id="footer_about" name="footer_about"
                            class="h-30 pl-4 pr-4 text-lg input-blog-form input-blog-form-focus"
                            placeholder="Describe Yourself and Your Relationship with Topic"></textarea>
                        <div class="flex justify-center">
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection