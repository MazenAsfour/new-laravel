<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationRequests extends Model
{
    protected $table="notification_requests";

    protected $fillable = [
        'user_id',
        'is_user_read',
        'status',
    ];
}
