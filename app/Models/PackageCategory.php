<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageCategory extends Model
{
    use HasFactory, HasTranslations, HasSlug;

    protected $guarded = [];

    public $translatable = ['name', 'description', 'note'];

    protected $casts = [
        'is_active' => 'boolean',
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

    // is active scope
    public function scopePublished($query)
    {
        return $query->where('is_active', true);
    }

    public function packages()
    {
        return $this->hasMany(Package::class, 'category_id');
    }
}
