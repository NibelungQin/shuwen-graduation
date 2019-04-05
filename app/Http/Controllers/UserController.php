<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
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
