<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'invoice_number',
        'total_amount',
        'status',
        'invoice_date',
    ];

    protected $dates = [
        'invoice_date',
    ];

    // Relationship: Invoice belongs to an Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relationship: Invoice belongs to a User through Order
    public function user()
    {
        return $this->hasOneThrough(User::class, Order::class, 'id', 'id', 'order_id', 'user_id');
    }

    // Example: Generate invoice number automatically
    public static function boot()
    {
        parent::boot();

        static::creating(function ($invoice) {
            if (!$invoice->invoice_number) {
                $invoice->invoice_number = 'INV-' . strtoupper(uniqid());
            }
        });
    }
}