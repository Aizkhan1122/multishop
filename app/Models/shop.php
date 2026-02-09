<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'owner_id',
        'status',
    ];

    /**
     * A shop can have many products
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * A shop belongs to an owner (admin or user)
     */
    public function owner()
    {
        return $this->belongsTo(Admin::class, 'owner_id');
    }
}