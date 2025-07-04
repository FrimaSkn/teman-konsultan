<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

     protected $fillable = [
        'name',
        'email',
        'phone',
        'area',
        'subject',
        'message',
    ];

    /**
     * Mark the consultation as read.
     *
     * @return void
     */
    public function markAsRead()
    {
        $this->is_read = true;
        $this->save();
    }
}
