<?php

namespace App\Http\Controllers;

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

    public function show()
    {
        return 2333;
    }
}
