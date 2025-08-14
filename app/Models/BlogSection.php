<?php

namespace App\Models;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class BlogSection extends Model
{
    /** @use HasFactory<\Database\Factories\BlogSectionFactory> */
    use HasFactory;


    //Identify which attributes are mass-assignable
    protected $fillable = [
        'heading',
        'content',
        'section_image',
        'position'
    ];


    //Creation of a Model LifeCycle Event for BlogSection
    //booted() static eloquent hook called when model class in intialized
    //Used to register event listeners
    /**
     * Automatically updates the position for a blog section for a blog
     * @return void
     */
    protected static function booted()
    {
        //Use of the creating function for a model event
        static::creating(function ($section) {
            //Check if position is already set
            if (is_null($section->position)) {
                //Find the highest exisiting postion for a blog's section
                $max = $section->blog->sections()->max('position') ?? 0;
                //Assign the new section to max + 1
                $section->position = $max + 1;
            }
        });
    }
    /**
     * Identify a relationship with a blog which blog sections belong to a blog
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<Blog, BlogSection>
     */
    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }

    /**
     * Return the section image as a URL, Storage Path or Null
     * @return string|null
     */
    public function getSectionImageSrcAttribute(): string|null
    {
        if (!$this->section_image) {
            return null;
        }
        //External URL
        if (Str::startsWith($this->section_image, ['http://', 'https://'])) {
            return $this->section_image;
        }
        //Stored Image File
        return Storage::disk('public')->url($this->section_image);
    }


}
