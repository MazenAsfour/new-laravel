<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $table="Notifications";

    protected $fillable = [
        "notifiable_type"
        ,"notifiable_id",
        "data",
        "read_at",
        "created_at"
    ];
}
