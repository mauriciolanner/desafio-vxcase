<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'delivery_days',
        'reference',
        'image',
        'stock',
        'created_at',
        'updated_at'
    ];

    use SoftDeletes;
}
