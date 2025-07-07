<header>
    <nav class="bg-black p-4">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center">
            <div class="text-white font-bold text-3xl mb-4 lg:mb-0 hover:text-purple-600 hover:cursor-pointer">
                <p>Blog App<i class="fa fa-users ml-2" aria-hidden="true"></i>
                </p>
            </div>
            <div class="lg:hidden">
                <button class="text-white focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16m-7 6h7">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="lg:flex flex-col lg:flex-row lg:space-x-4 lg:mt-0 mt-4 flex items-center text-xl">
                <a href="{{route('home')  }}" class="text-white px-4 py-2 hover:text-purple-600">Home</a>
                <a href="#" class="text-white px-4 py-2 hover:text-purple-600">Blogs</a>
                <a href="#" class="text-white px-4 py-2 hover:text-purple-600">About</a>
                <a href="#" class="text-white px-4 py-2 hover:text-purple-600">Contact</a>
                <a href="{{route('register')  }}" class="text-white px-4 py-2 hover:text-purple-600">SignUp</a>
                <a href="{{route('login')  }}" class="text-white px-4 py-2 hover:text-purple-600">Login</a>

            </div>
        </div>
    </nav>
</header>