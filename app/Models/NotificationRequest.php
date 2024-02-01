<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRequest extends Model
{
    protected $table = 'notification_requests';

    protected $dates = ['created_at', 'updated_at'];


    public function markAsReadByUser()
    {
        $this->is_user_read = 1;
        $this->save();

        return $this;
    }
}



