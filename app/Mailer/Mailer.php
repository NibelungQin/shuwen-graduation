<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/2/25
 * Time: 14:12
 */

namespace App\Mailer;

/**
 * 邮件发送的基础模板
 */
use Illuminate\Support\Facades\Mail;

class Mailer
{
    /**
     * @param string $template 邮件模板
     * @param string $email    接收邮件用户邮箱
     * @param string $title    邮件标题
     * @param array  $data     发送的数据
     */
    protected function sendTo($template,$email,$title,array $data){
        Mail::send($template,$data,function ($message) use ($email,$title){
            $message->to($email)->subject($title);
        });
    }
}
