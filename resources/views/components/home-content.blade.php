<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">

    <a href="{{ route('blogs-index') }}">
        <div class="
        max-w-sm 
        rounded overflow-hidden shadow-lg duration-500 hover:scale-105 hover:shadow-lg">
            <img class="w-full h-80 object-cover" src="https://images.pexels.com/photos/262508/pexels-photo-262508.jpeg"
                alt="man and trumpet">
            <div class="px-6 py-4 bg-slate-100">
                <div class="font-bold text-xl mb-2"> The Reading Experience</div>
                <p class="text-gray-700 text-base">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Molestias
                    ab
                    alias totam excepturi quaerat nemo facere nihil illo nobis magnam.</p>
            </div>
        </div>
    </a>
    <!-- Send to Create Blog page or login page -->
    @guest
        @php
            $destination = 'login';
        @endphp
    @else
        @php
            $destination = 'user-blogs-create';
        @endphp
    @endguest

    <a href="{{ route($destination) }}">
        <div class="max-w-sm rounded overflow-hidden shadow-lg duration-500 hover:scale-105 hover:shadow-lg">
            <img class="w-full h-80 object-cover"
                src="https://images.pexels.com/photos/5052875/pexels-photo-5052875.jpeg" alt="piano">
            <div class="px-6 py-4 bg-slate-100">
                <div class="font-bold text-xl mb-2"> The Writing Experience</div>
                <p class="text-gray-700 text-base">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis
                    blanditiis
                    maiores tempore dolores modi magnam iste soluta itaque magni velit.</p>
            </div>
        </div>
    </a>
    <a href="{{ route('about') }}">
        <div class="max-w-sm rounded overflow-hidden shadow-lg duration-500 hover:scale-105 hover:shadow-lg">
            <img class="w-full h-80 object-cover"
                src="https://images.pexels.com/photos/6140697/pexels-photo-6140697.jpeg" alt="guitar">
            <div class="px-6 py-4 bg-slate-100">
                <div class="font-bold text-xl mb-2"> The Community Experience</div>
                <p class="text-gray-700 text-base">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis
                    blanditiis
                    maiores tempore dolores modi magnam iste soluta itaque magni velit.</p>
            </div>
        </div>
    </a>
</div>