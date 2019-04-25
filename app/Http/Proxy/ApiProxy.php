<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/4/18 0018
 * Time: 下午 2:11
 */

namespace App\Http\Proxy;


use GuzzleHttp\Client;

class ApiProxy
{
    protected $http;

    public function __construct(Client $http)
    {
        $this->http = $http;
    }

    public function get($base,$router)
    {
        $url = $base.$router;
        $response = $this->http->get($url);
        $body = $response->getBody();
        return $body;
    }

    public function post($base,$router,$data)
    {
        $response = $this->http->post('http://httpbin.org/post', [
            'form_params' => [        //参数组
                'a' => 'aaa',
                'b' => 'bbb',
                'nested_field' => [		//参数允许嵌套多层
                    'A' => 'AAA',
                    'B' => 'BBB',
                ]
            ],
        ]);
        $body = $response->getBody(); //获取响应体，对象
        return $body;
    }
}