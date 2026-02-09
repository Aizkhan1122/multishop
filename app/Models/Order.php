<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
     use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'subtotal',
        'discount',
        'shipping',
        'tax',
        'status',
    ];

    // Order belongs to a user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Order has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
    
    // Order has one invoice
    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
    
    // Accessor for items (alias for orderItems)
    public function getItemsAttribute()
    {
        return $this->orderItems;
    }
}