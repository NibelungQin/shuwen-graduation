<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/25
 * Time: 10:55
 */
if (!function_exists('user')){

    /**
     * 获得API认证用户信息
     * @param null $driver
     * @return mixed
     */
    function user($driver = null){
        if ($driver){
            return app('auth')->guard('api')->user();
        }
        return app('auth')->user();
    }
}
