<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogSection extends Model
{
    /** @use HasFactory<\Database\Factories\BlogSectionFactory> */
    use HasFactory;

    protected $casts = [
        'images' => 'array',
    ];
    protected $fillable = [
        'heading',
        'content',
        'images',
        'position'
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
