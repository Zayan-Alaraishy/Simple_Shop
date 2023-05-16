<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Define the fillable attributes of the model
    protected $fillable = [
        'name',
        'description',
        'category_id',
        'unit_price',
        'visibility',
        'average_rating',
        'stock',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}