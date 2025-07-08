<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    protected $casts = [
        'hero_topics' => 'array',
        'hero_authors' => 'array',
    ];
    protected $fillable = [
        'user_id',
        'name',
        'author',
        'hero_title'
    ];
    public function sections()
    {
        return $this->hasMany(BlogSection::class)
            ->orderBy('position');
    }
    public function related()
    {
        return $this->$this->belongsToMany(
            Blog::class,
            'blog_related',
            'blog_id',
            'related_blog_id'
        );
    }
}
