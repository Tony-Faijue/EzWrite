@extends('layouts.layout')

@section('content')

    <div class="bg-grad-2 flex min-h-screen">
        <x-user.side-nav />

        <div class="flex-1 flex flex-col">
            <div class="flex-1 overflow-auto space-y-6 place-self-center mt-10">
                <div>
                    <a href="{{ route('sections-create', $blog) }}"><button class="create-section-btn">Create A New
                            Section</button></a>
                </div>
                <ul>
                    @foreach ($sections as $section)
                        <div class="user-form-bg my-4">
                            <li>
                                <x-card.section-cards>

                                    <h1 class="text-center text-2xl">{{$section->heading}}</h1>

                                    <!-- Section Image -->
                                    @empty($section->section_image)
                                        <p>No Image Available</p>
                                    @else
                                        <img src="{{ $section->section_image }}" class="shadow-lg shadow-cyan-200 w-auto mt-2 mb-2">
                                    @endempty

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