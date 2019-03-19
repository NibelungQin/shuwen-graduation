<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * 保存私信内容到数据库，并发送站内性通知
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        $data = [
            'from_user_id' => user('api')->id,
            'to_user_id'   => \request('user'),
            'body'         => \request('body'),
            'dialog_id'    => time().user('api')->id
        ];
        $message = $this->messageRepository->create($data);
        if ($message){
            $message->toUser->notify(new NewMessageNotification($message));
            return response()->json(['status'=>true]);
        }
        return response()->json(['status'=>false]);
    }
}
