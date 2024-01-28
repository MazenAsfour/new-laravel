<?php
namespace App\Http\Controllers;

use App\Models\NotificationRequest;
use Illuminate\Http\Request;
use Auth;
use App\Models\UserData;
class NotificationController extends Controller
{
    public function fetchNotifications()
    {
        $notifications = NotificationRequest::where("user_id",Auth::user()->id)->orderBy("id","desc")->get();
        $userdata = UserData::where("user_id",Auth::user()->id)->first();
        $total_points = 0;
        $unreaded = NotificationRequest::where("user_id",Auth::user()->id)->where("status",1)->where("is_user_read",0)->count();
        if($userdata){
            $total_points = $userdata->points;
        }
        print_R(json_encode(["success"=>true,"data"=>$notifications,"total_points"=>$total_points,"unreaded"=>$unreaded]));
    }


    public function markReaded(NotificationRequest $notification)
    {
        NotificationRequest::where("user_id",Auth::user()->id)->update([
            "is_user_read"=>1
        ]);
        print_R(json_encode(["success"=>true]));

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