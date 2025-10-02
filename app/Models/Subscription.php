<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_item',
        'subscription_number',
        'status',
        'contract_type',
        'started_at',
        'ended_at',
    ];
}
