<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/12
 * Time: 17:55
 */

namespace App\Repositories;


use App\User;

class UserRepository
{
    public function byId($id)
    {
        return User::find($id);
    }

    /**
     * 获取用户
     *
     * @param $username
     * @return mixed
     */
    public function getUserByName($username)
    {
        $user = User::where('name', $username)->first();
        return $user;
    }
}
