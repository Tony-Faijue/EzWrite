@extends('layouts.layout')

@section('content')

    <div class="bg-grad-2 flex min-h-screen">
        <x-user.side-nav />

        <div class="flex-1 flex flex-col">
            <div class="flex-1 overflow-auto space-y-6 place-self-center mt-10">
                <ul>
                    @foreach ($sections as $section)
                        <div class="user-form-bg my-4">
                            <li>
                                <x-card.section-cards>

                                    <h1 class="text-center text-2xl">{{$section->heading}}</h1>
                                    <!-- Images -->
                                    <!-- <div class="">
                                                <ul class="flex flex-row flex-nowrap overflow-x-auto gap-4 mt-2 mb-2">
                                                    @forelse ($section->images ?? [] as $image)
                                                    <li class="">{{$image}}</li>
                                                    @empty
                                                    <li>No Images are listed</li>
                                                    @endforelse

                                                </ul>
                                            </div> -->
                                    <!-- Hero Image -->
                                    <!-- @empty($blog->hero_image)
                                                                                                <p>No Image Available</p>
                                                                                            @else
                                                                                                <img src="{{ $blog->hero_image }}" class="shadow-lg shadow-cyan-200 w-auto mt-2 mb-2">
                                                                                            @endempty -->
                                    <!-- Authors -->
                                    <!-- <ul class="flex flex-row flex-nowrap overflow-x-auto gap-2 mt-2 mb-2">
                                                                                        <p class="text-sm">Contributors:</p>
                                                                                        @forelse ($blog->hero_authors ?? [] as $author)
                                                                                            <li class="text-sm">{{$author}}</li>
                                                                                        @empty
                                                                                            <li>No other authors are listed</li>
                                                                                        @endforelse
                                                                                    </ul> -->

                                    <!-- Content -->
                                    <p class="mt-2 mb-2">{{ $section->content }}</p>
                                    <!-- Update Button -->
                                    <div class="grid grid-cols-4">
                                        <button class="update-blog-btn col-start-1 col-end-2">Update</button>
                                        <button class="delete-blog-btn col-start-4">Delete</button>
                                    </div>
                                </x-card.section-cards>
                            </li>
                        </div>
                    @endforeach
                </ul>
            </div>
            <!-- Pagnation Links -->
            <div>
                <div class="flex justify-end mr-4 mb-4">
                    {{ $sections->links() }}
                </div>
            </div>
        </div>


@endsection

    @section('footer')
        <x-footer />
    @endsection