@extends('layouts.layout')



@section('content')
    <div class="bg-grad-2 flex min-h-screen">
        <div class="flex-1 flex flex-col">
            <div class="flex-1 overflow-auto space-y-6 place-self-center mt-10">
                <ul>
                    <!-- Loop through each blog -->
                    @foreach ($blogs as $blog)
                        <div class="user-form-bg my-4">
                            <li>
                                <!-- import of blog-cards component -->
                                <x-card.blog-cards>
                                    <!-- Display properties of $blog -->
                                    <h1 class="text-center text-2xl">{{$blog->hero_title}}</h1>
                                    <p class="text-center mt-2 mb-2">written by <i>{{ $blog->user->firstname }}
                                            {{ $blog->user->lastname }}</i></p>
                                    <!-- Topics -->
                                    <div class="">
                                        <ul class="flex flex-row flex-nowrap overflow-x-auto gap-4 mt-2 mb-2">
                                            <!-- Use of null coalescing operator ??  
                                                                To check if the array hero_topics exists and is not null use its value
                                                                otherwise use an empty array-->
                                            <!-- Use of @forelse directive with @empty -->
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
            <!-- Pagnation Links -->
            <div>
                <div class="flex justify-end mr-4 mb-4">
                    {{ $blogs->links() }}
                </div>
            </div>
        </div>


@endsection

    @section('footer')
        <x-footer />
    @endsection