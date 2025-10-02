<?php

namespace App\Domains\Auth\Models\Traits\Relationship;

use App\Models\Post;
use App\Domains\Auth\Models\PasswordHistory;

/**
 * Class UserRelationship.
 */
trait UserRelationship
{
    /**
     * @return mixed
     */
    public function passwordHistories()
    {
        return $this->morphMany(PasswordHistory::class, 'model');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function cartItems()
    {
        return $this->hasMany(\App\Models\CartItem::class, 'user_id', 'id');
    }
}
