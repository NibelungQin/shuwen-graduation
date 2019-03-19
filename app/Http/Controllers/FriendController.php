<?php

namespace App\Http\Controllers;

use App\Notifications\SendFriendNotification;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($id)
    {
        $user = $this->userRepository->byId($id);
        $senders = $user->receivers()->pluck('sender_id')->toArray();
        if (in_array(user('api')->id, $senders)){
            return response()->json(['followed'=>true]);
        }
        return response()->json(['followed'=>false]);
    }

    /**
     * 发送好友申请
     */
    public function send()
    {
        $toUser = $this->userRepository->byId(\request('user'));
        $toUser->notify(new SendFriendNotification());
    }

    /**
     * 接收处理好友申请
     */
    public function receiver()
    {
        $toUser = $this->userRepository->byId(\request('user'));
        user('api')->acceptThisUser($toUser);
    }
}
