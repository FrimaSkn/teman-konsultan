<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'fraud_status',
        'gross_amount',
        'payment_type',
        'transaction_id',
        'transaction_status',
        'transaction_time',
        'url',
        'status_code',
        'status_message',
        'va_numbers',
    ];



}
