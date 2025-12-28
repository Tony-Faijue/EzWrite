@extends('layouts.layout')

@section('content')
    <div class="border border-transparent bg-grad-2 min-h-screen">
        <div class="container mx-auto px-4 my-8 sm:px-6 lg:px-8 space-y-12">
            <!-- Attention Getter -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="space-y-6">
                    <div class="container mx-auto px-4 py-8 my-6 sm:px-6 lg:px-8 space-y-6">
                        <p class="text-base place-self-end bg-white border border-purple-400 rounded-lg px-2">Dive in head
                            first
                            into the
                            experience</p>
                        <h1 class="text-3xl md:text-4xl lg:text-6xl author-bold">Start Your Journey With Blogs</h1>
                        <p class="text-base md:text-lg lg:text-xl bg-white border border-purple-400 rounded-lg px-2">Lorem
                            ipsum
                            dolor sit amet consectetur adipisicing elit.
                            Quaerat consectetur illum, modi iste maxime delectus?</p>
                        <div class="flex justify-center gap-8 md:gap-14">
                            <button
                                class="p-2 border border-purple-600 bg-slate-50 rounded-lg text-lg md:text-xl lg:text-2xl text-purple-700 hover:bg-slate-200">Explore
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
            <div class="flex justify-center">
                <h1 class="md:place-self-center author-bold text-2xl md:text-3xl lg:text-4xl">
                    Welcome</h1>
            </div>
            <div class="place-self-center grid grid-cols-1 md:grid-cols-2 gap-6 border border-amber-300 ">
                <div class="text-center space-y-4 bg-slate-100 rounded-lg">
                    <h1 class="sm:text-xl md:text-2xl lg:text-3xl">Welcome to EzWrite</h1>
                    <p class="text-base md:text-lg lg:text-xl">Welcome to EzWrite, where you can write and share your
                        stories,
                        giving the world your unique insight and
                        perspective on topics that you care about. Here you can view the wonderful stories of others on any
                        topic and get their perspectives. </p>
                </div>
                <div class="text-center space-y-4 bg-slate-100 rounded-lg">
                    <h1 class="sm:text-xl md:text-2xl lg:text-3xl">Importance of Writing</h1>
                    <p class="text-base md:text-lg lg:text-xl">Writing is an essential part of modern human society. The
                        importance of writing and its benefits cannot
                        be stressed enough such as improve creativity, organizing thoughts, learning, dealing with emotions
                        and
                        effective communication. Writing helps us connect with others in expressing our thoughts and telling
                        our
                        stories. </p>
                </div>
            </div>
        </div>
    </div>
@endsection