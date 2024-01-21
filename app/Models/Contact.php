<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table="contact";

    protected $fillable = [
        "user_name",
        "user_email",
        "message",
        "is_read",
        "replayed",
        "created_at",
    ];
}
