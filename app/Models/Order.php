<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ([
        'user_id',
        'order_number',
        'product_id',
        'price',
        'qty',
        'total',
    ]);

    // App\Models\Order.php
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
