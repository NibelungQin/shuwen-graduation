<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25
 * Time: 13:51
 */

namespace App\Channels;


use Illuminate\Notifications\Notification;

class EmailChannel
{
    public function send($notifiable, Notification $notification)
    {
        $message = $notification->toSend($notifiable);
    }
}
