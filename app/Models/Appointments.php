<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Appointments extends Model
{
    use Notifiable;

    protected $table="appointments";
    protected $fillable = [
        "user_id",
        "product_id",
        "product_total_price",
        "product_name",
        "product_checkin_date",
        "product_checkout_date",
        "is_verifiyed",
        "is_approved",
        "is_read",

    ];
   
}
