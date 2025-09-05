<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sumorder extends Model
{
    use HasFactory;

    protected $fillalbe = ([
        'user_id',
        'order_number',
        'grand_total',
        'cash',
    ]);
}
