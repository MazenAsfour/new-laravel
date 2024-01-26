<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table="categories";

    protected $fillable = [
        "name",
        "category_id",
        "description",
        "created_at",
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}