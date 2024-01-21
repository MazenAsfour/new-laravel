<?php

namespace App\Notifications;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

/**
 * Summary of postNewNotifications
 */
class postNewNotifications extends Notification
{
    use Queueable;
    private $User;
    public function __construct(User $User)
    {
      $this->User=$User;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            "title"=>"New member joined",
            'id' => $this->User->id,
            'name' => $this->User->name,
            'email' => $this->User->email,
        ];
    }

}
