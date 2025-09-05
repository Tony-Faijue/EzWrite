@extends('layouts.layout')

@section('content')
    <div class="w-full">
        <div class="border border-red-500 p-4 space-y-12">
            <div class="border border-purple-500 p-4 rounded-2xl space-y-4">
                <div class="border border-amber-400 space-y-8">
                    <h1 class="text-3xl md:text-4xl lg:text-5xl text-purple-800 text-center">Lorem ipsum dolor sit amet
                        consectetur
                        adipisicing elit. Explicabo
                        recusandae,
                        similique culpa ad
                        fuga
                        voluptatum et possimus iusto molestias aliquid.</h1>
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
            <div class="border border-green-400 p-4">
                <div class="container flex flex-row border border-red-600">
                    <div class="border border-blue-800 grid grid-cols-2 w-full gap-x-8">
                        <div class="border border-amber-200">
                            <p>Text Info</p>
                        </div>
                        <div class="border border-amber-200">
                            <img
                                src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?q=80&w=1172&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection