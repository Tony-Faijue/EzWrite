@extends('layouts.layout')

@section('content')
    <div class="bg-grad-2 flex min-h screen">
        <x-user.side-nav />
        <div class="flex-1 flex flex-col">
            <div
                class="flex-1 overflow-auto space-y-6 place-self-center mt-10 mb-5 border-8 border-gray-50 w-full mr-2 full-bg-card">
                <h1 class="text-5xl text-center">{{ $section->heading }}
                </h1>
                <div class="flex flex-col justify-center gap-6">
                    @if($section->section_image)
                        <!-- Check if the image is a URL, File Located in Storage or null -->
                        <img src="{{ Str::startsWith($section->section_image, ['http://', 'https://']) ? $section->section_image : asset('storage/' . $section->section_image) }}"
                            alt="Section Image" class="w-250 h-150 place-self-center rounded-2xl" />
                    @endif
                    <p class="ml-10 mr-10 text-md lg:text-xl ">{{$section->content}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection