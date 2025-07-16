<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSection extends Model
{
    /** @use HasFactory<\Database\Factories\BlogSectionFactory> */
    use HasFactory;


    protected $fillable = [
        'heading',
        'content',
        'section_image',
        'position'
    ];

    //Automatically Increment postion
    //Creation of a Model Event for BlogSection
    /**
     * Automatically updates the position for blogsection for a blog
     * @return void
     */
    protected static function booted()
    {
        static::creating(function ($section) {
            if (is_null($section->position)) {
                $max = $section->blog->sections()->max('position') ?? 0;
                $section->position = $max + 1;
            }
        });
    }

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }


}
