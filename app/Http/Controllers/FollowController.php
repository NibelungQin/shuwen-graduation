<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index($id)
    {
        $user = $this->userRepository->byId($id);
        $followers = $user->followersUser()->pluck('follower_id')->toArray();

        if (in_array(user('api')->id, $followers)){
            return response()->json(['followed'=>true]);
        }
        return response()->json(['followed'=>false]);
    }

    public function follow()
    {
        $userToFollow = $this->userRepository->byId(\request('user'));
        $followed = user('api')->followThisUser($userToFollow);

        if (count($followed['attached'])>0){
            $userToFollow->increment('followers_count');
            return response()->json(['followed'=>true]);
        }
        $userToFollow->decrement('followers_count');
        return response()->json(['followed'=>false]);
    }

}
