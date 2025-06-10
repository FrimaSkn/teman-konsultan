<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\MediaLibrary\HasMedia;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ServicesCategory extends Model implements HasMedia
{
    use HasFactory, HasSlug, InteractsWithMedia;

    protected $fillable = [
        'name',
        'slug',
        'description',
    ];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function registerMediaCollections(): void
    {
        $this
        ->addMediaCollection('service_category')
        ->useDisk('public_service');
    }

    public function services()
    {
        return $this->hasMany(Services::class, 'category_id');
    }


    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDescriptionAttribute($value)
    {
        return $value ?: 'No description available';
    }

    public function getNameAttribute($value)
    {
        return $value ?: 'Unnamed Service';
    }
}
