<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{
    /**
     * 获得站内性通知列表
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $user = user('api');
        $notifications = $user->notifications;
        $notifications = collect($notifications)->map(function ($notification){
            $notification['type'] = class_basename($notification->type);
            return $notification;
        })->toArray();
        return response()->json(['notifications'=>$notifications]);
    }

    /**
     * 判断通知是否未读
     * @return \Illuminate\Http\JsonResponse
     */
    public function unread()
    {
        $notification = \request('notification');
        $result = $notification->unread();
        if ($result){
            return response()->json(['read'=>true]);
        }
        return response()->json(['read'=>false]);
    }

    /**
     * 将未读通知标为已读
     * @param DatabaseNotification $notification
     */
    public function show(DatabaseNotification $notification)
    {
        $notification->markAsRead();
    }
}
