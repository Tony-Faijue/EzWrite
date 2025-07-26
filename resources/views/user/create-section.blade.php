@extends('layouts.layout')

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
            <!-- Form for user to create blog section -->
            <!-- Pass the blog parameter to the section-store route  -->
            <form action="{{ route('sections-store', $blog) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid gap-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h2 class="text-4xl text-center">Create a New Section</h2>
                        <!-- Heading -->
                        <label for="heading" class="text-2xl">Heading</label>
                        <input type="text" id="heading" name="heading"
                            class="h-15 pl-4 pr-4 input-blog-form input-blog-form-focus" placeholder="Enter the Heading"
                            required />
                        <!-- Content -->
                        <label for="content" class="text-2xl">Content</label>
                        <textarea id="content" name="content"
                            class="h-50 pl-4 pr-4 text-lg input-blog-form input-blog-form-focus"
                            placeholder="Enter your Blog Content Here" required></textarea>
                        <!-- Section Image -->
                        <h2 class="text-lg">(Optional) Provide an image URL or image file. If both are provided the image
                            file
                            will be used.</h2>
                        <!-- Optional Url Image -->
                        <label for="section_image_url" class="text-2xl">Section Image URL</label>
                        <input type="url" id="section_image_url" name="section_image_url"
                            class="h-10 pl-4 pr-4 input-blog-form input-blog-form-focus"
                            placeholder="https://example.com/image.jpg" />
                        <!-- Optional File Image -->
                        <label for="section_image_file" class="text-2xl">Section Image File</label>
                        <input type="file" id="section_image_file" name="section_image_file"
                            class="h-10 pl-4 pr-4 input-blog-form input-blog-form-focus" accept="image/*" />
                        <div class="flex justify-center">
                            <button type="submit" class="submit-btn">Submit</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection