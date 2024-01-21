<?php

namespace App\Notifications;
use App\Models\Admin;
use App\Models\User;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

/**
 * Summary of postNewNotifications
 */
class AddNewAdmin extends Notification
{
    protected $data;
    
    public function __construct($data)
    {
        $this->data = $data;
    }
    public function via($notifiable)
    {
        return ['database'];
    }
    public function toDatabase($notifiable)
    {
        $admin1=Admin::orderBy("id","desc")->get()->first();
        $newAdmin=User::where("id", $admin1->user_id)->get()->first();
        return [
            'title' => Auth::user()->name.' Add ' . $newAdmin->name. ' As New Admin',
            'admin_id'=>Auth::user()->id
        ];
    }

}
