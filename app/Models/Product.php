<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'cat_id',
        'name',
        'slug',
        'short_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'status',
        'trending'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
}
