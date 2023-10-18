<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'chapter',
        'type',
        'code',
        'price',
        'color',
        'size',
        'description',
        'specifications',
        'images',
        'rating',
    ];

    protected $allowedSorts = [
        'price',
        'created_at',
        'updated_at'
    ];
}
