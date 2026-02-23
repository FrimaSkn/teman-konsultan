<?php

namespace App\Models;

use App\Domains\Auth\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'status',
        'total_amount',
        'manual_order'
    ];

    protected $with = ['orderItems', 'payment'];

    const STATUS_PENDING = 'pending';
    const STATUS_PAID = 'paid';
    const STATUS_FAILED = 'failed';
    const STATUS_CANCELLED = 'cancelled';

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($order) {
            $order->order_number = self::generateOrderNumber();
        });
    }

    private static function generateOrderNumber(): string
    {
        $lastOrder = self::orderByDesc('id')->first();

        if ($lastOrder === null) {
            $orderNumber = 'W' . date('ym') . '000001';
            return $orderNumber;
        }

        $orderNumber = 'W' . date('ym') . str_pad($lastOrder->id + 1, 6, '0', STR_PAD_LEFT);
        return $orderNumber;
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class, 'order_number', 'order_number');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
