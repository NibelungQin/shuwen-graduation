<?php

namespace App\Http\Controllers;

use App\Http\Resources\CommentResource;
use App\Repositories\CommentRepository;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $userRepository;
    public $commentRepository;

    public function __construct(UserRepository $userRepository,
                                CommentRepository $commentRepository)
    {
        $this->userRepository = $userRepository;
        $this->commentRepository = $commentRepository;
    }

    /**
     * 用户详情
     *
     * @param Request $request
     * @param $username
     * @return PreviewUserResource
     */
    public function show(Request $request, $username)
    {
        $user = $this->userRepository->getUserByName($username);

        $user->followings_count = $user->followers()->count();
        $user->comments_count = $user->comments()->count();

//        $currentAuthUser = user('api');
//
//        if ($currentAuthUser->check()) {
//            if ($currentAuthUser->user()->id != $user->id) {
//                $user->is_following = $currentAuthUser->user()->isFollowing($user->id);
//            }
//        }
        return $user;

//        return new PreviewUserResource($user);
    }

    public function replies(Request $request,$username)
    {
        $user = $this->userRepository->getUserByName($username);
        $comments = $this->commentRepository->userReply($user->id);
        return CommentResource::collection($comments);
    }

    public function following($username)
    {
        $user = $this->userRepository->getUserByName($username);
        $followings = $user->followers;
        return $followings;

//        return FollowingResource::collection($followings);
    }

    /**
     * 修改头像
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function avatar(Request $request)
    {
        $avatar = $request->input('avatar');
        $user = user('api');
        $result = $user->update(['avatar'=>$avatar]);
        if ($result){
            return response()->json([
                'message' => '头像修改成功'
            ]);
        }
        return response()->json([
            'message' => '头像修改失败'
        ]);
    }

    public function password(Request $request)
    {
//        $password =
    }
}
