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
        'meta_title',
        'meta_description',
        'focus_keyword',
        'canonical_url',
        'robots',
        'status',
    ];

    public $translatable = [
        'title',
        'excerpt',
        'content',
        'slug',
        'meta_title',
        'meta_description',
        'focus_keyword',
    ];

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

        $this
        ->addMediaCollection('post_og_image')
        ->singleFile()
        ->useDisk('public_post');
    }

    public function getSeoTitleAttribute(): string
    {
        return $this->meta_title ?: (string) $this->title;
    }

    public function getSeoDescriptionAttribute(): string
    {
        return $this->meta_description ?: (string) ($this->excerpt ?? '');
    }

    public function getSeoImageAttribute(): ?string
    {
        return $this->getFirstMediaUrl('post_og_image')
            ?: $this->getFirstMediaUrl('post_image')
            ?: null;
    }

    public function getSeoRobotsAttribute(): string
    {
        if ($this->status !== 'published') {
            return 'noindex,nofollow';
        }

        return $this->robots ?: 'index,follow';
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
