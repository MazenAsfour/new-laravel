<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table="products";

    protected $fillable = [
        "name",
        "price",
        "image_path",
        "category_id",
        "description",
        "created_at",
    ];
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
