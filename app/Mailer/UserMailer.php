<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25
 * Time: 14:15
 */

namespace App\Mailer;


class UserMailer extends Mailer
{
    public function welcome()
    {

    }

    /**
     * 用户关注发送邮箱
     * @param $email
     */
    public function followUser($email)
    {
        $template = 'emails.followUser';
        $title = '用户关注';
        $data = [
            'name' => user('api')->name,
        ];
        $this->sendTo($template,$email,$title,$data);
    }
}
