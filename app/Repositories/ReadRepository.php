<?php
/**
 * Created by PhpStorm.
 * User: Nibelung Qin
 * Date: 2019/5/1
 * Time: 13:58
 */

namespace App\Repositories;


use App\Model\Read;

class ReadRepository
{
    public function getReadLog()
    {
        $reads = user('api')->reads()->orderBy('updated_at','desc')->paginate(10);

        return $reads;
    }
    
    /**
     * 添加浏览记录
     * @param $readableId
     * @param $readableType
     * @return mixed
     */
    public function store($readableId,$readableType)
    {
        $data = [
            'user_id' => user('api')->id,
            'readable_id' => $readableId,
            'readable_type' => $readableType
        ];
        //判断该浏览记录是否存在
        $read = Read::where($data)->first();
        if (!$read){
            return Read::create($data);
        }
        //若记录存在，则修改其更新时间
        return Read::where($data)->update(['show_count'=>0,'updated_at' => date('Y-m-d H:i:s',time())]);
    }

    /**
     * 获得最新一条阅读记录
     * @return mixed
     */
    public function readLog()
    {
        $where = [
            'user_id' => user('api')->id,
        ];
        return Read::where($where)->orderBy('updated_at','desc')->first();
    }
}