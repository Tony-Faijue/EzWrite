@extends('layouts.layout')

@section('content')
    <div class="flex min-h-screen">
        <!-- import of user side-nav component -->
        <x-user.side-nav />
        <div class="flex-1 flex flex-col px-2 md:px-4">
            <div class="flex-1 overflow-auto space-y-6 place-self-center w-full ">

                <!-- Hero Information -->
                <div class="justify-items-center">
                    <h1 class="text-5xl lg:text-7xl mt-4 mb-4 text-center">{{ $blog->hero_title }}</h1>
                    <p class="text-lg text-center"> written by {{ $blog->user->firstname}} {{ $blog->user->lastname}} /
                        {{ $blog->created_at }}
                    </p>
                </div>
                <!-- Topics -->
                <div>
                    <ul class="flex flex-row flex-wrap place-content-center overflow-x-auto gap-4 mt-2 mb-2">

                        @forelse($blog->hero_topics ?? [] as $topic)
                            <li class="bg-purple-600 text-slate-200 text-xl rounded-2xl pl-2 pr-2">{{ $topic }}</li>
                        @empty
                            <li>No topics are listed</li>
                        @endforelse
                    </ul>
                </div>
                <!-- Hero Image -->
                @empty($blog->hero_image_src)
                    <p class="text-center text-red-600">No Image Available</p>
                @else
                    <img class="w-full" src="{{ $blog->hero_image_src }}">
                @endempty

                <!-- Introduction -->
                <div class="text-center  border-l-4 border-purple-700">
                    <p class="text-2xl">{{ $blog->intro }}</p>
                </div>

                <!-- Display All Sections for the Blog -->
                <div class="place-self-center space-y-8">
                    @foreach ($sections as $section)
                        <div class="justify-items-center space-y-2">
                            <h1 class="text-3xl lg:text-5xl text-center px-8">{{ $section->heading }}</h1>
                            <p class="text-lg text-center px-8">{{ $section->content }}</p>
                            @if($section->section_image)
                                <img class="w-full aspect-4/3" src="{{ $section->section_image_src }}">
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Contributors/Authors -->
                <div class="flex justify-center text-lg lg:text-2xl">
                    <ul class="flex flex-row flex-nowrap overflow-x-auto gap-2 mt-2 mb-2">
                        <p>Contributors:</p>
                        @forelse ($blog->hero_authors ?? [] as $author)
                            <li>{{ $author }}</li>
                        @empty
                            <li>No other authors are listed</li>
                        @endforelse
                    </ul>
                </div>

                <!-- Footer -->
                <div class="flex justify-center mb-2">
                    <p class="text-lg text-justify px-8">{{ $blog->footer_about }}</p>
                </div>

            </div>
        </div>
    </div>
@endsection