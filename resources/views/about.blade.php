@extends('layouts.layout')

@section('content')
    <div class="w-full">
        <div class="border border-red-500 p-4 space-y-12">
            <div class="border border-purple-500 p-4 rounded-2xl space-y-4">
                <div class="border border-amber-400 space-y-8">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl text-purple-800 text-center">EzWrite keeps things simplistic
                        so you can focus on what matters, your words. Join us to create, connect and share without
                        distractions. </h1>
                </div>
                <div class="border border-amber-400 space-y-8">
                    <p class="text-base md:text-lg lg:text-xl text-purple-700 author-italic text-center">Lorem ipsum, dolor
                        sit amet
                        consectetur adipisicing elit. Maxime
                        expedita,
                        aspernatur dolores
                        suscipit ratione architecto veritatis debitis nam odio praesentium rerum quia consequatur amet alias
                        est sit eos eligendi dignissimos quas et velit modi fuga obcaecati sapiente? Quia, nostrum est.</p>
                </div>
            </div>
            <div class="border border-green-400 p-4 space-y-8">
                <!-- About Us -->
                <div class="container mx-auto">
                    <div class="flex flex-row border border-red-600">
                        <div class="border border-blue-800 grid grid-cols-1 md:grid-cols-2 w-full gap-x-8">
                            <div class="border border-amber-200 space-y-4">
                                <h1 class="text-center sm:text-2xl md:text-3xl lg:text-4xl text-purple-700">About Us</h1>
                                <p class="text-base md:text-lg lg:text-xl text-purple-700">The goal of EzWrite is to create
                                    an environment
                                    where users can develop their writing
                                    skills when it comes to writing in a blog structured format.
                                </p>
                                <ul
                                    class="border border-amber-400 list-disc text-purple-700 text-base md:text-lg lg:text-xl ml-8">
                                    <li>Community Driven : Users support and learn from one another. </li>
                                    <li>Custom Topics/Tags : Organize your posts any way you want and help readers find the
                                        conversations that matter to them. </li>
                                    <li>Blog Management : You control your content, create, update or delete posts whenever
                                        you need and choose to make them public or private. </li>
                                    <li>Print-Friendly Blogs : Grab your favorite posts in a printer-ready format for
                                        offline reading, sharing and archiving. </li>
                                    <li> Low-Stakes Environment : No paywalls, no premiums plans. Just a relaxed space to
                                        experiment and grow as a writer. </li>
                                </ul>
                            </div>
                            <div class="border border-amber-200">
                                <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="min-w-full min-h-full" />
                            </div>
                        </div>
                    </div>

                </div>
                <!-- About Me -->
                <div class="container mx-auto">
                    <div class="flex flex-row border border-red-600">
                        <div class="border border-blue-800 grid grid-cols-1 md:grid-cols-2 w-full gap-x-8">
                            <div class="border border-amber-200">
                                <img src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                    class="min-w-full min-h-full" />
                            </div>
                            <div class="border border-amber-200 space-y-4">
                                <h1 class="text-center sm:text-2xl md:text-3xl lg:text-4xl text-purple-800">About Me</h1>
                                <p class="text-base md:text-lg lg:text-xl text-purple-700">I am the founder of EzWrite .
                                    What began as a
                                    simple experiment building a place where
                                    anyone could sign up, create and publish blogs became a passion project for me. I dove
                                    into blogging myself to sharpen my communication and make sense of topics I cared about.
                                    The reason I built EzWrite is to offer a relaxed and welcoming environment where writing
                                    feels natural with minimal complications. </p>
                            </div>

                        </div>
                    </div>

                </div>

                <!-- Community -->
                <div class="container mx-auto">
                    <div class="flex flex-col border border-red-400 space-y-4">
                        <div class="text-center">
                            <h1 class="sm:text-2xl md:text-3xl lg:text-4xl text-purple-800">Community</h1>
                        </div>
                        <div class="text-center">
                            <p class="text-base md:text-xl lg:text-2xl text-purple-700">At EzWrite, we are building a
                                vibrant
                                community where bloggers come together to share ideas,
                                explore diverse topics and improve their writing. Whether you are just starting with you
                                blogging journey or you have been writing for years, you will find a welcoming space full of
                                encouragement and collaboration. Join EzWrite to sharpen your skills, expand your knowledge
                                and
                                make meaningful contributions in a supportive environment designed to help you succeed. </p>
                        </div>
                        <div class="border border-amber-200 place-self-center w-auto h-1/2">
                            <img
                                src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection