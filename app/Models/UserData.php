<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;

    protected $table = "personal_data_of_users";

    protected $fillable = [
        'user_id',
        'image_path',
        'about_user',
        'free_gift',
        'points',
        'card_number',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}