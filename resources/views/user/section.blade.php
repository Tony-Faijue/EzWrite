@extends('layouts.layout')

@section('content')
    <div class="bg-grad-2 flex min-h screen">
        <x-user.side-nav />
        <div class="flex-1 flex flex-col sm:px-25 md:px-50">
            <div class="flex-1 overflow-auto space-y-6 place-self-center mt-10 mb-10 w-full full-bg-card">
                <h1 class="heading mt-4 text-center">{{ $section->heading }}
                </h1>
                <div class="flex flex-col justify-center gap-6">
                    @if($section->section_image_src)
                        <!-- Check if the image is a URL, File Located in Storage or null -->
                        <img src="{{ $section->section_image_src}}" alt="Section Image"
                            class="2xl:w-250 2xl:h-150 place-self-center rounded-2xl object-contain" />
                    @endif
                    <p class="px-10 text-base sm:text-lg mb-8 preserve-whitespace">{{$section->content}}</p>
                </div>
            </div>
        </div>
    </div>
@endsection