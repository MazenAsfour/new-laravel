<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $table="rating";

    protected $fillable = [
        "id",
        "name",
        "email",
        "description",
        "is_approved",
        "product_name",
        "product_id",
        "rating",
        "product_created_at",
        "is_read",

    ];
}
