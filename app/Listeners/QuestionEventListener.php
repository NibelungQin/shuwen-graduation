<?php

namespace App\Listeners;

use App\Events\QuestionViewEvent;
use App\Model\Question;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Redis;

class QuestionEventListener
{
    /**
     * 一个问题的最大访问数
     */
    const questionViewLimit = 20;

    /**
     * 同一用户浏览同一个帖子的过期时间
     */
    const ipExpireSec = 300;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuestionViewEvent  $event
     * @return void
     */
    public function handle(QuestionViewEvent $event)
    {
        $question = $event->question;
        $ip = $event->ip;
        $id = $question->id;
        if ($this->ipViewLimit($id, $ip)){
            $this->updateCacheViewCount($id,$ip);
        }
    }

    /**
     * 限制同一IP一段时间内得访问,防止增加无效浏览次数
     * @param $id
     * @param $ip
     * @return bool
     */
    public function ipViewLimit($id,$ip)
    {
        $ipQuestionViewKey = 'shuwen:question:ip:limit:'.$id;
        //Redis命令SISMEMBER检查集合类型Set中有没有该键,Set集合类型中值都是唯一
        $exitInRedisSet = Redis::command('SISMEMBER', [$ipQuestionViewKey, $ip]);
        //如果集合中不存在这个建 那么新建一个并设置过期时间
        if (!$exitInRedisSet){
            Redis::command('SADD', [$ipQuestionViewKey, $ip]);
            Redis::command('EXPIRE', [$ipQuestionViewKey, self::ipExpireSec]);
            return true;
        }
        return false;
    }

    /**
     * 达到要求更新数据库的浏览量
     * @param $id
     * @param $count
     */
    public function updateQuestionViewCount($id,$count)
    {
        $question = Question::find($id);
        $question->increment('view_count', $count);
    }

    /**
     * 不同用户访问,更新缓存中浏览次数
     * @param $id
     * @param $ip
     */
    public function updateCacheViewCount($id, $ip)
    {
        //这里以Redis哈希类型存储键,就和数组类似,$cacheKey就类似数组名 如果这个key存在
        $cacheKey = 'shuwen:question:view:'.$id;
        if (Redis::command('HEXISTS', [$cacheKey, $ip])){
            //哈希类型指令HINCRBY,就是给$cacheKey[$ip]加上一个值,这里一次访问就是1
            $count = Redis::command('HINCRBY', [$cacheKey, $ip, 1]);
            if ($count == self::questionViewLimit){
                //redis中这个存储浏览量的值达到20后,就去刷新一次数据库
                $this->updateQuestionViewCount($id, $count);
                //redis中浏览量刷进MySQL后,就把该问题的浏览量清空,重新开始计数
                Redis::command('HDEL', [$cacheKey, $ip]);
            }
        }else{
            //哈希类型指令HSET,和数组类似,就像$cacheKey[$ip] = 1;
            Redis::command('HSET', [$cacheKey, $ip, '1']);
        }
    }
}
