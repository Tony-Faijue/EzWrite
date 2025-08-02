<?php

namespace App\Policies;

use App\Models\Blog;
use App\Models\BlogSection;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BlogSectionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user, Blog $blog): bool
    {
        return $user->id === $blog->user_id;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, BlogSection $section): bool
    {
        return $user->id === $section->blog->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user, Blog $blog): bool
    {
        return $user->id === $blog->user_id;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, BlogSection $section): bool
    {
        return $user->id === $section->blog->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, BlogSection $section): bool
    {
        return $user->id === $section->blog->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, BlogSection $section): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, BlogSection $section): bool
    {
        return false;
    }
}
