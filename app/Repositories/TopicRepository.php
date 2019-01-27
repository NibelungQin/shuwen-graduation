<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/1/23
 * Time: 17:01
 */

namespace App\Repositories;


use App\model\Topic;
use Illuminate\Http\Request;

class TopicRepository
{
    /**
     * 获得标签栏搜索出现类似的标签
     * @param Request $request
     * @return mixed
     */
    public function getTopicsForTagging(Request $request)
    {
        $query = $request->query('q');
        if (!empty($query)){
            return Topic::select(['id','name'])
                ->where('name', 'like', '%'.$query.'%')
                ->get();
        }
    }

    /**
     * 获得标签id和创建新的标签
     * @param array $topics
     * @return array
     */
    public function normalizeTopic(array $topics)
    {
        return collect($topics)->map(function ($topic){
            if (is_numeric($topic)){
                Topic::find($topic)->increment('questions_count');
                return intval($topic);
            }
            $newTopic = Topic::create(['name' => $topic]);
            $newTopic->increment('questions_count');
            return $newTopic->id;
        })->toArray();
    }
}
