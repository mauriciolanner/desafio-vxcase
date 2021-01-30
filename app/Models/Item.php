<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'price_id',
        'product_id',
        'cart_id',
        'created_at',
        'updated_at'
    ];

    use SoftDeletes;
}
