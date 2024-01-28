<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationRequest extends Model
{
    // Specify the table name if it's different from the default
    protected $table = 'notification_requests';

    // Specify the columns that should be casted to dates
    protected $dates = ['created_at', 'updated_at'];

    // ...

    public function markAsReadByUser()
    {
        // Update the is_user_read column to 1
        $this->is_user_read = 1;
        $this->save();

        return $this;
    }
}


    // You can define any relationships or additional configurations here


