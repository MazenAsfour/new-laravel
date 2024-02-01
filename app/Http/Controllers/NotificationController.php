<?php
namespace App\Http\Controllers;


use  Illuminate\Support\Facades\Hash;
use  Illuminate\Support\Facades\Auth;
use App\Models\NotificationRequests;
use App\Models\UserData;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function fetchNotifications()
    {
        $notifications = NotificationRequests::where("status",1)->where("user_id",Auth::user()->id)->get();

        $unread = NotificationRequests::where("status",1)->where("is_user_read",0)->where("user_id",Auth::user()->id)->count();

        $totalPoints = UserData::where('user_id', Auth::user()->id)->get()->sum('points');

        print_r(json_encode(['data'=>$notifications, "success"=>true , "unreadData"=>$unread,"totalPointes"=>$totalPoints]));
        die;
    }



    public function markAsReadByUser()
    {
       NotificationRequests::where("user_id",Auth::user()->id)->where("status",1)->where("is_user_read",0)->update([
        "is_user_read" =>1
       ]);
    
        return response()->json(['message' => 'Notification marked as read by user']);
    }


//     public function fetchUnreadNotificationCount()
// {
//     $count = NotificationRequests::where('status', 1)
//         ->where('is_user_read', 0)
//         ->count();

//     return response()->json(['count' => $count]);
// }

}