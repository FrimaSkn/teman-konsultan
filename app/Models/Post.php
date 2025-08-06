<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use App\Domains\Auth\Models\User;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Spatie\Sluggable\HasTranslatableSlug;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model implements HasMedia
{
    use HasFactory, HasTranslations, InteractsWithMedia, HasTranslatableSlug;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'content',
        'excerpt',
        'status',
    ];

    public $translatable = ['title', 'excerpt', 'content', 'slug'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function scopeFindBySlugOrFail($query, string $slug): Model
    {
        return $query->where(function ($query) use ($slug) {
            foreach (['en', 'id'] as $locale) {
                $query->orWhereJsonContains("slug->$locale", $slug);
            }
        })->firstOrFail();
    }


    public function registerMediaCollections(): void
    {
        $this
        ->addMediaCollection('post_image')
        ->useDisk('public_post');
    }

    // public function getRouteKeyName()
    // {
    //     return 'slug';
    // }

    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    public function scopeArchived($query)
    {
        return $query->where('status', 'archived');
    }

    // user relation
    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
