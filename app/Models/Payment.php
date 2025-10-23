<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'transaction_id',
        'currency',
        'amount',
        'status',
        'payment_url',
        'payload'

    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
