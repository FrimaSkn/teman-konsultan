<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_item',
        'note',
        'subscription_number',
        'status',
        'contract_type',
        'started_at',
        'ended_at',
    ];

    protected $with = ['user'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->subscription_number = self::generateOrderNumber();
        });
    }

    private static function generateOrderNumber(): string
    {
        $last = self::orderByDesc('id')->first();

        if ($last === null) {
            $number = 'S' . date('ym') . '000001';
            return $number;
        }

        $number = 'S' . date('ym') . str_pad($last->id + 1, 6, '0', STR_PAD_LEFT);
        return $number;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItem::class, 'order_item', 'id');
    }
}
