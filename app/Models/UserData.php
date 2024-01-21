<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    protected $table="personal_data_of_users";

    protected $fillable = [
        'user_id',
        'image_path',
        'about_user',
        'use_cookie',
        'save_login',
       
    ];
}
