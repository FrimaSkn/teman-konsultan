<?php

namespace App\Models;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, HasSlug, HasTranslations;

    protected $guarded = [];

    public $translatable = ['title'];

    protected $with = ['category'];

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function category()
    {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }

    public function cartItems()
    {
        return $this->hasMany(\App\Models\CartItem::class, 'package_id', 'id');
    }

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class, 'package_id', 'id');
    }
}
