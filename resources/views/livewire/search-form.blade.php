<div>
    <!-- Search Form -->
    <div class="mb-6">
        <div class="full-bg-card ml-4 mr-4 space-y-4 py-8">
            <div class="border border-purple-500 px-4">
                <!-- Title Search -->
                <div class="w-full mt-4">
                    <label for="title" class="author-semibold">Search for title* or additional:</label>
                    <input id="title" class="input-form input-form-focus" type="text" wire:model.live="title"
                        placeholder="Search by title/intro/username/firstname/lastname..." class="form-input">
                </div>
                <!-- Topics Multi-Select -->
                <div>
                    <label class="author-semibold">Filter by Topics:</label>

                    <!-- Selected Topics (Tags) -->
                    @if(!empty($topics))
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($topics as $selectedTopic)
                                <span class="bg-purple-600 text-slate-200 text-xl rounded-2xl pl-2 pr-2 flex items-center">
                                    {{ $selectedTopic }}
                                    <button wire:click="removeTopicFilter('{{ $selectedTopic }}')"
                                        class="ml-2 text-slate-100 hover:text-orange-400 focus:outline-none"><i
                                            class="fa-solid fa-xmark mt-2"></i></button>
                                </span>
                            @endforeach
                        </div>
                    @endif
                    <!-- Topic Selector -->
                    <select wire:change="addTopicFilter($event.target.value); $event.target.value=''"
                        class="w-full px-3 py-2 border border-purple-500 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="">Add a topic...</option>
                        @foreach($availableTopics as $topic)
                            @if(!in_array($topic, $topics))
                                <option value="{{ $topic }}">{{ $topic }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Contributing Authors Multi-Select -->
                <div>
                    <label class="author-semibold">Filter by Contributors:</label>

                    <!-- Selected Authors (Tags) -->
                    @if(!empty($authors))
                        <div class="flex flex-wrap gap-2 mb-3">
                            @foreach($authors as $selectedAuthor)
                                <span class="bg-purple-600 text-slate-200 text-xl rounded-2xl pl-2 pr-2 flex items-center">
                                    {{ $selectedAuthor }}
                                    <button wire:click="removeAuthorFilter('{{ $selectedAuthor }}')"
                                        class="ml-2 text-slate-100 hover:text-orange-400 focus:outline-none"><i
                                            class="fa-solid fa-xmark mt-2"></i></button>
                                </span>
                            @endforeach
                        </div>
                    @endif

                    <!-- Author Selector -->
                    <select wire:change="addAuthorFilter($event.target.value); $event.target.value=''"
                        class="w-full px-3 py-2 border border-purple-500 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                        <option value="">Add an author...</option>
                        @foreach($availableAuthors as $author)
                            @if(!in_array($author, $authors))
                                <option value="{{ $author }}">{{ $author }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <!-- Sorting -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <!-- Sort By -->
                    <div class="flex-1">
                        <label class="author-semibold">Sort by:</label>
                        <select wire:model.live="sortBy"
                            class="w-full px-3 py-2 border border-purple-500 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600">
                            <option value="created_at">Created Date</option>
                            <option value="updated_at">Updated Date</option>
                            <option value="hero_title">Title</option>
                        </select>
                    </div>

                    <select wire:model.live="sortDir"
                        class="form-select px-3 py-2 border border-purple-500 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-600 mt-6 ">
                        <option value="desc">Descending</option>
                        <option value="asc">Ascending</option>
                    </select>

                    <!-- Clear Filters -->
                    <button wire:click="clearFilters"
                        class="w-25 mt-6 bg-purple-600 hover:bg-purple-700 text-white font-semibold py-3 rounded-lg shadow-md transition-all duration-200;">Clear
                        All</button>
                </div>


                <!-- Results -->
                <div class="mb-6 mt-2 flex justify-between items-center">
                    <p class="text-purple-600">Found {{ $totalResults }} result(s)</p>
                    <div class="text-sm text-purple-500">
                        Page {{ $blogs->currentPage() }} of {{ $blogs->lastPage() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Results -->
        <ul class="container">
            <div class="grid lg:grid-cols-2 xl:grid-cols-3 gap-8 p-16">
                <!-- Loop through each blog -->
                @forelse ($blogs as $blog)
                    <li class="blog-card-bg">
                        <a href="{{ route('blogs-show', $blog) }}">
                            <!-- import of blog-cards component -->
                            <x-card.blog-cards>
                                <!-- Hero Image -->
                                <div class="aspect-square border border-amber-300">
                @empty($blog->hero_image_src)
                                    <p>No Image Available</p>
                                @else
                                                    <img src="{{ $blog->hero_image_src }}"
                                                        class="blog-card-img shadow-md shadow-slate-700 w-auto">
                                                    @endempty
                                                </div>
                                                <!-- Display properties of $blog -->
                                                <div class="aspect-16/9">
                                                    <h1 class="text-center text-2xl">{{$blog->hero_title}}</h1>
                                                    <p class="text-center mt-2 mb-2">written by <i>{{ $blog->user->firstname }}
                                                            {{ $blog->user->lastname }}</i></p>
                                                    <!-- Topics -->
                                                    <div class="">
                                                        <ul class="flex flex-row flex-nowrap overflow-x-auto gap-4 mt-2 mb-2">
                                                            <!-- Use of null coalescing operator ??  
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            To check if the array hero_topics exists and is not null use its value
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                            otherwise use an empty array-->
                                                            <!-- Use of forelse directive with empty -->
                                                            @forelse ($blog->hero_topics ?? [] as $topic)
                                                                <li class="bg-neutral-400 rounded-2xl pl-2 pr-2">{{$topic}}</li>
                                                            @empty
                                                                <li>No topics are listed</li>
                                                            @endforelse
                                                        </ul>
                                                    </div>

                                                    <!-- Contributers -->
                                                    <ul class="flex flex-row flex-nowrap overflow-x-auto gap-2 mt-2 mb-2">
                                                        <li class="text-sm">Contributors:</li>
                                                        @forelse ($blog->hero_authors ?? [] as $author)
                                                            <li class="text-sm">{{$author}}</li>
                                                        @empty
                                                            <li>No other authors are listed</li>

                                                        @endforelse
                                                    </ul>

                                                    <!-- Introduction -->
                                                    <p class="mt-2 mb-2">{{ $blog->intro }}</p>
                                                </div>

                                            </x-card.blog-cards>
                                        </a>
                                    </li>
                                @empty
                    <div
                        class="text-center py-12 border bg-white rounded-lg border-b-4 border-r-4 border-r-purple-800 border-b-purple-800 border-purple-500 xl:col-start-2">
                        <div class="text-purple-600 text-5xl mb-4"><i class="fa-solid fa-magnifying-glass"></i></div>
                        <h3 class="text-lg author-bold text-purple-900 mb-2">No blogs found</h3>
                        <p class="text-purple-400 px-2">Try adjusting your search criteria or clear the filters.</p>
                        <button wire:click="clearFilters"
                            class="mt-4 px-4 py-2 bg-slate-100 text-purple-500 rounded hover:bg-purple-600 hover:text-slate-100">
                            Clear All Filters
                        </button>
                    </div>
                @endforelse
            </div>
        </ul>

        <!-- Pagination -->
        <div>
            <div class="flex justify-end mr-4 mb-4">
                {{ $blogs->links() }}
            </div>
        </div>
    </div>