<header>
    <!-- User NavBar -->
    <nav class="p-4">
        <div class="container mx-auto flex flex-col lg:flex-row justify-between items-center">
            <div class="text-purple-900 font-bold text-3xl mb-4 lg:mb-0 hover:text-orange-400 hover:cursor-pointer">
                <a href="{{ route('welcome') }}">
                    <p>{{ config('app.name') }}<i class="fa fa-users ml-2" aria-hidden="true"></i>
                </a>
                </p>
            </div>
            <div class="lg:hidden">
                <button class="text-purple-900 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M4 6h16M4 12h16m-7 6h7">
                        </path>
                    </svg>
                </button>
            </div>
            <div class="lg:flex flex-col lg:flex-row lg:space-x-4 lg:mt-0 mt-4 flex items-center text-xl">
                <a href="{{route('user-home')  }}" class="text-purple-900 px-4 py-2 hover:text-orange-400">My
                    Dashboard</a>
                <a href="{{route('home')  }}" class="text-purple-900 px-4 py-2 hover:text-orange-400">Home</a>
                <a href="{{ route('blogs-index') }}" class="text-purple-900 px-4 py-2 hover:text-orange-400">Blogs</a>
                <a href="{{ route("about") }}" class="text-purple-900 px-4 py-2 hover:text-orange-400">About</a>
                <a href="{{ route('contact-form-show') }}"
                    class="text-purple-900 px-4 py-2 hover:text-orange-400">Contact</a>
                <!-- Use of a form to handle logout function -->
                <form id="logout-form" action="{{route('logout')}}" method="POST">
                    @csrf
                    <button type="submit" class="text-purple-900 px-4 py-2 hover:text-orange-400">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>
</header>