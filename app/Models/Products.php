<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table="products";

    protected $fillable = [
        "product_name",
        "product_price",
        "product_image_path",
        "product_description",
        "product_created_at",
        "catogry",
    ];
}
