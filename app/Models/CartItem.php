<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'package_id',
        'payload',
        'quantity',
        'min_contract',
        'contract_type',
    ];

    protected $with = ['package'];

    public function user()
    {
        return $this->belongsTo(\App\Domains\Auth\Models\User::class, 'user_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id', 'id');
    }
}
