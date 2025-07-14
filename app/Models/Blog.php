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
        'hero_title',
        'intro',
        'hero_topics',
        'hero_authors',
        'hero_image',
        'footer_about'
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sections()
    {
        return $this->hasMany(BlogSection::class)
            ->orderBy('position');
    }
    public function related()
    {
        return $this->belongsToMany(
            Blog::class,
            'blog_related',
            'blog_id',
            'related_blog_id'
        );
    }
}
