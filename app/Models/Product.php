<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
     use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
        'shop_id',
        'stock',
    ];

    // 🔹 Relationships

    // A product belongs to a category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // A product belongs to a shop
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // A product can be in many carts
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    // A product can be in many wishlists
    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    // A product can appear in many orders (order_items)
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
