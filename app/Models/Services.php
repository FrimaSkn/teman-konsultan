<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    use HasFactory, HasSlug, HasTranslations;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
    ];

    public $translatable = ['name', 'description'];


    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(ServicesCategory::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getDescriptionAttribute($value)
    {
        return $value ?: 'No description available.';
    }

    public function getNameAttribute($value)
    {
        return $value ?: 'Unnamed Service';
    }
}
