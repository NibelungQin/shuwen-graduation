<?php

namespace App\Http\Controllers;

use App\Notifications\NewMessageNotification;
use App\Repositories\MessageRepository;
use Illuminate\Http\Request;

class InboxController extends Controller
{
    protected $messageRepository;

    public function __construct(MessageRepository $messageRepository)
    {
        $this->messageRepository = $messageRepository;
    }

    /**
     * 获得用户发送和接收的信息(根据dialog_id分组)
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $messages = $this->messageRepository->getAllMessages();
        $messages = $messages->groupBy('dialog_id');
        return response()->json(['messages'=>$messages]);
    }

    /**
     * 显示私信消息
     * @param $dialogId
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($dialogId)
    {
        $page = \request('page', 0);
        $result = $this->messageRepository->getDialogMessage($dialogId, $page-1);
        $messages = $result['messages'];
        $messages->markAsRead();
        return response()->json([
            'messages' => $messages,
            'count'=>$result['count']
        ]);
    }

    /**
     * 发送消息
     * @param $dialogId
     */
    public function store($dialogId)
    {
        $message = $this->messageRepository->getSingleMessage($dialogId);
        $toUserId = $message->from_user_id === user('api')->id ? $message->to_user_id : $message->from_user_id;
        $data = [
            'from_user_id' => user('api')->id,
            'to_user_id'   => $toUserId,
            'body'         => \request('body'),
            'dialog_id'    => $dialogId
        ];
        $newMessage = $this->messageRepository->create($data);
        $newMessage->toUser->notify(new NewMessageNotification($newMessage));
    }
}
