<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    //Attribute casting allows these attributes to be casted as arrays
    protected $casts = [
        'hero_topics' => 'array',
        'hero_authors' => 'array',
    ];
    //Identify which attributes can be mass-assigned
    protected $fillable = [
        'hero_title',
        'intro',
        'hero_topics',
        'hero_authors',
        'hero_image',
        'footer_about'
    ];
    /**
     * Defines a relationship with a user which a blog belongs to a user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Blog>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * Defines a relationship with sections which a blog has many sections
     * @return \Illuminate\Database\Query\Builder
     */
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
