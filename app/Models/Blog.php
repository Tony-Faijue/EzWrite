<?php

namespace App\Models;

use File;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
class Blog extends Model
{
    /** @use HasFactory<\Database\Factories\BlogFactory> */
    use HasFactory;

    //Attribute casting allows these attributes to be casted as arrays
    protected $casts = [
        'hero_topics' => 'array',
        'hero_authors' => 'array',
        'is_public' => 'boolean',
    ];
    //Identify which attributes can be mass-assigned
    protected $fillable = [
        'hero_title',
        'intro',
        'is_public',
        'hero_topics',
        'hero_authors',
        'hero_image',
        'footer_about'
    ];
    /**
     * function that is a lifecycle hook for blog model
     * @return void
     */
    protected static function booted()
    {
        // delete stored image file on public disk
        static::deleting(function (Blog $blog) {
            if ($blog->hero_image && !str_starts_with($blog->hero_image, 'http')) {
                Storage::disk('public')->delete($blog->hero_image);
            }
            //delete corresponding sections
            $blog->sections->each->delete();
        });
    }
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
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sections()
    {
        return $this->hasMany(BlogSection::class)
            ->orderBy('position');
    }
    /**
     * Returns hero image as a URL, Storage Path, or Null
     * @return string|null
     */
    public function getHeroImageSrcAttribute(): string|null
    {

        if (!$this->hero_image) {
            return null;
        }
        //External URL
        if (Str::startsWith($this->hero_image, ['http://', 'https://'])) {
            return $this->hero_image;
        }
        //Stored Image File
        return Storage::disk('public')->url($this->hero_image);
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
