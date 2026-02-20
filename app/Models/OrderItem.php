<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'package_id',
        'payload',
        'contract_type',
        'quantity',
        'price',
    ];

    protected $with = ['package', 'subscription', 'package'];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }

    public function subscription()
    {
        return $this->hasOne(Subscription::class, 'order_item', 'id');
    }
}
