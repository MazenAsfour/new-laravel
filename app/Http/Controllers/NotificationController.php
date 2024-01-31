<?php
namespace App\Http\Controllers;

use App\Models\NotificationRequest;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function fetchNotifications()
    {
        $notifications = NotificationRequest::all();

        $transformedNotifications = $notifications
    ->filter(function ($notification) {
        return $notification->status == 1;
    })
    ->map(function ($notification) {
        $message = 'The admin has accepted the point';

        return [
            'id' => $notification->id,
            'user_id' => $notification->user_id,
            'status' => $notification->status,
            'is_user_read' => $notification->is_user_read,
            'created_at' => $notification->created_at,
            'updated_at' => $notification->updated_at,
            'message' => $message,
        ];
    });

        
        return response()->json($transformedNotifications);
    }



    public function markAsReadByUser(NotificationRequest $notification)
    {
        $notification->is_user_read = 1;
        $notification->save();
    
        return response()->json(['message' => 'Notification marked as read by user']);
    }


    public function fetchUnreadNotificationCount()
{
    $count = NotificationRequest::where('status', 1)
        ->where('is_user_read', 0)
        ->count();

    return response()->json(['count' => $count]);
}

}