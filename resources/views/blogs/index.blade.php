@extends('layouts.layout')

@section('header')
    <x-nav />
@endsection

@section('content')
    <div class="bg-grad-2 flex">
        <div class="flex-1 flex justify-center items-center">
            <ul>
                @foreach ($blogs as $blog)
                    <div class="user-form-bg my-4">
                        <li>
                            <x-card.blog-cards>

                                <h1 class="text-center text-2xl">{{$blog->hero_title}}</h1>
                                <p class="text-center mt-2 mb-2">written by <i>{{ $blog->author }}</i></p>
                                <!-- Topics -->
                                <div class="">
                                    <ul class="flex flex-row flex-nowrap overflow-x-auto gap-4 mt-2 mb-2">
                                        @forelse ($blog->hero_topics ?? [] as $topic)
                                            <li class="bg-gray-300 rounded-2xl pl-2 pr-2">{{$topic}}</li>
                                        @empty
                                            <li>No topics are listed</li>
                                        @endforelse

                                    </ul>
                                </div>
                                <!-- Hero Image -->
                                @empty($blog->hero_image)
                                    <p>No Image Available</p>
                                @else
                                    <img src="{{ $blog->hero_image }}" class="shadow-lg shadow-cyan-200 w-auto mt-2 mb-2">
                                @endempty
                                <!-- Authors -->
                                <ul class="flex flex-row flex-nowrap overflow-x-auto gap-2 mt-2 mb-2">
                                    <p class="text-sm">Contributors:</p>
                                    @forelse ($blog->hero_authors ?? [] as $author)
                                        <li class="text-sm">{{$author}}</li>
                                    @empty
                                        <li>No other authors are listed</li>
                                    @endforelse
                                </ul>

                                <!-- Introduction -->
                                <p class="mt-2 mb-2">{{ $blog->intro }}</p>
                            </x-card.blog-cards>
                        </li>
                    </div>
                @endforeach
            </ul>
        </div>
    </div>
@endsection

@section('footer')
    <x-footer />
@endsection