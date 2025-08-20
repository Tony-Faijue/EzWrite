<?php

namespace App\Livewire;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

/**
 * Component to Query Blogs
 */
class SearchForm extends Component
{

    use WithPagination;
    //Query Parameters

    //
    /**
     * Special case:
     * Title property here is being used to query for
     * title, intro, username, firstname and lastname of the blog owner 
     * @var string
     */
    public string $title = '';
    /**
     * An array of topics for a blog.
     * @var array
     */
    public array $topics = [];
    /**
     * An array of contributors for a blog.
     * @var array
     */
    public array $authors = [];
    /**
     * A string to sort by created_at or updated_at
     * @var string
     */
    public string $sortBy = 'created_at';
    /**
     * A string for sort direction 'desc' or 'asc'
     * @var string
     */
    public string $sortDir = 'desc';

    /**
     * Maximum number of blogs displaying per page.
     * @var int
     */
    public int $perPage = 12;
    /**
     * Boolean value to show only public blogs.
     * @var bool
     */
    public bool $showPublic = true;
    /**
     *Livewire protected property for displaying in the url
     * @var array
     */
    protected $queryString = [
        'title' => ['except' => ''],
        'topics' => ['except' => []],
        'authors' => ['except' => []],
        'sortBy' => ['except' => 'created_at'],
        'sortDir' => ['except' => 'desc'],
        'page' => ['except' => 1],
    ];
    /**
     *Livewire protected property to be invoked when $this->validate is called
     * @var array
     */
    protected $rules = [
        'title' => 'string|max:255',
        'topics' => 'array|max:10',
        'topics.*' => 'string|max:255',
        'authors' => 'array|max:5',
        'authors.*' => 'string|max:255',
        'sortBy' => 'in:created_at,updated_at,hero_title',
        'sortDir' => 'in:asc,desc',
        'perPage' => 'integer|min:5|max:50',
    ];
    /**
     * A lifecycle hook that fires before any pubic property changes
     * and reset pagination when those search parameters change
     * @param mixed $field
     * @return void
     */
    public function updating($field)
    {
        //Check if one of the corresponding fields are being updated
        if (in_array($field, ['title', 'topics', 'authors', 'sortBy', 'sortDir'])) {
            $this->resetPage();
        }
    }
    /**
     * Add a topic to the array of topics 
     * @param string $topic
     * @return void
     */
    public function addTopicFilter(string $topic)
    {
        if (!in_array($topic, $this->topics)) {
            $this->topics[] = $topic;
        }
    }
    /**
     * Add author to the array of authors
     * @param string $author
     * @return void
     */
    public function addAuthorFilter(string $author)
    {
        if (!in_array($author, $this->authors)) {
            $this->authors[] = $author;
        }
    }
    /**
     * Remove topic from the array of topics
     * @param string $topic
     * @return void
     */
    public function removeTopicFilter(string $topic)
    {
        //Filter the array to remove topics in the array that are equal to topic parameter
        $this->topics = array_values(array_filter($this->topics, fn($t) => $t !== $topic));
    }
    /**
     * Remove author from the array of authors
     * @param string $author
     * @return void
     */
    public function removeAuthorFilter(string $author)
    {
        //Filter the array to remove authors in the array that are equal to author parameter
        $this->authors = array_values(array_filter($this->authors, fn($a) => $a !== $author));
    }
    /**
     * Get available topics for dropdown list
     * @return array
     */
    public function getAvailableTopicsProperty()
    {
        //Query Topics
        return Blog::query()
            ->when($this->showPublic, fn($q) => $q->where('is_public', true))
            ->whereNotNull('hero_topics')
            ->get()
            ->pluck('hero_topics')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();
    }
    /**
     * Get available authors for dropdown list
     * @return array
     */
    public function getAvailableAuthorsProperty()
    {
        //Query Author Contributors
        return Blog::query()
            ->when($this->showPublic, fn($q) => $q->where('is_public', true))
            ->whereNotNull('hero_authors')
            ->get()
            ->pluck('hero_authors')
            ->flatten()
            ->filter()
            ->unique()
            ->sort()
            ->values()
            ->toArray();
    }

    /**
     * Clear all the filters
     * @return void
     */
    public function clearFilters()
    {
        $this->title = '';
        $this->topics = [];
        $this->authors = [];
        $this->sortBy = 'created_at';
        $this->sortDir = 'desc';
        $this->resetPage();
    }
    /**
     *A lifecycle hook function that returns a blade and data
     *that patches what has been changed in the browser
     */
    public function render()
    {
        //Apply the rules to public properties
        $this->validate();

        /**
         * Query the Blog model for Title and Intro of Blog & Firstname, Lastname and Name of Blog Owner
         * @var mixed
         */
        $query = Blog::query()
            ->with('user')
            ->when($this->showPublic, fn($q) => $q->where('is_public', true))
            ->when($this->title, function ($q) {
                $q->where(function ($subQuery) {
                    $subQuery->where('hero_title', 'like', "%{$this->title}%")
                        ->orWhere('intro', 'like', "%{$this->title}%")
                        ->orWhereHas('user', function ($userQuery) {
                            $userQuery->where('firstname', 'like', "%{$this->title}%")
                                ->orWhere('lastname', 'like', "%{$this->title}%")
                                ->orWhere('name', 'like', "%{$this->title}%");
                        });
                });
            });

        //Handle topics filtering, test if any of the topics exist in the blog
        if (!empty($this->topics)) {
            $query->where(function ($q) {
                foreach ($this->topics as $topic) {
                    $q->orWhereJsonContains('hero_topics', $topic);
                }
            });
        }
        //Handle authors filtering, test if any of the authors exist in the blog
        if (!empty($this->authors)) {
            $query->where(function ($q) {
                foreach ($this->authors as $author) {
                    $q->orWhereJsonContains('hero_authors', $author);
                }
            });
        }

        // Apply sorting by and the direction
        $query->orderBy($this->sortBy, $this->sortDir);
        // get results
        $blogs = $query->paginate($this->perPage);

        //Return the blade view with corresponding data
        return view('livewire.search-form', [
            'blogs' => $blogs,
            'totalResults' => $blogs->total(),
            'availableTopics' => $this->availableTopics,
            'availableAuthors' => $this->availableAuthors,
        ])->layout('layouts.layout');
    }
}
