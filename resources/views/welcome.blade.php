@extends('layouts.layout')

@section('content')
    <div class="container mx-auto px-4 my-8 sm:px-6 lg:px-8 space-y-12">
        <!-- Attention Getter -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-6">
                <div class="container mx-auto px-4 py-8 my-6 sm:px-6 lg:px-8 space-y-6">
                    <p class="text-base place-self-end">Dive in head first into the experience</p>
                    <h1 class="text-3xl md:text-4xl lg:text-6xl">Start Your Journey With Blogs</h1>
                    <p class="text-base md:text-lg lg:text-xl">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Quaerat consectetur illum, modi iste maxime delectus?</p>
                    <div class="flex flex-row gap-8 md:gap-14">
                        <button
                            class="p-2 border border-purple-600 rounded-lg text-lg md:text-xl lg:text-2xl text-purple-700">Explore
                            Stories <i class="fa-solid fa-book ml-2"></i></button>
                        <button
                            class="p-2 bg-purple-600 border border-indigo-800 rounded-lg text-lg md:text-xl lg:text-2xl text-zinc-100 hover:bg-purple-700">Write
                            Your Story <i class="fa-solid fa-pencil ml-2"></i></button>

                    </div>
                </div>
            </div>

            <div class="bg-red-300 border border-slate-500">
                <img src="{{ asset('images/Bridge.jpg') }}" alt="Hero Image"
                    class="object-cover h-full rounded-2xl shadow-lg shadow-blue-600" />
            </div>
        </div>
        <!-- Blog Section -->
        <div class="place-self-center border border-slate-500 w-[50%]">
            <h1 class=" place-self-center">Heading</h1>
        </div>
    </div>
@endsection