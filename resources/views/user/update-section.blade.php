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
            <!-- Form for user to update blog section -->
            <!-- Pass the blog parameter to the section-edit route  -->
            <form action="{{ route('sections-update', [$blog, $section]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid gap-4">
                    <div class="grid grid-cols-1 gap-4">
                        <h2 class="text-4xl text-center">Update the Section</h2>
                        <!-- Heading -->
                        <label for="heading" class="text-2xl">Heading</label>
                        <input type="text" id="heading" name="heading"
                            class="h-15 pl-4 pr-4 input-blog-form input-blog-form-focus" placeholder="Enter the Heading"
                            value="{{ old('heading', $section->heading) }}" required />
                        <!-- Content -->
                        <label for="content" class="text-2xl">Content</label>
                        <textarea id="content" name="content"
                            class="h-50 pl-4 pr-4 text-lg input-blog-form input-blog-form-focus"
                            placeholder="Enter your Blog Content Here"
                            required>{{ old('content', $section->content) }}</textarea>

                        <!-- Section Image -->
                        @php
                            //Get the "current" image value, keep old if error occurs on validation, otherwise use database value
                            $current = old('section_image', $section->section_image);
                            //Determine if current is an external url
                            use Illuminate\Support\Str;
                            $isExternal = $current && Str::startsWith($current, ['http://', 'https://']);
                         @endphp

                        <h2 class="text-lg">(Optional) Provide an image URL or image file. If both are provided the image
                            file will be used.</h2>

                        <!-- Image Preview -->
                        <!-- Render the preview if there is an image stored -->
                        @if($current)
                            <div class="mb-4">
                                <label for="" class="block text-lg">Image Preview</label>
                                <img src="{{ $isExternal ? $current : asset('storage/' . $current) }}"
                                    alt="Section Image Preview" class="w-32 h-32 object-cover rounded border">
                            </div>
                        @endif
                        {{-- Use of a Hidden field to send the old image if no new one is given --}}
                        <input type="hidden" name="current_image" value="{{ $current }}">

                        <!-- Optional Url Image -->
                        <label for="section_image_url" class="text-2xl">Section Image URL</label>
                        <input type="url" id="section_image_url" name="section_image_url"
                            value="{{ old('section_image_url', $isExternal ? $current : '') }}"
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