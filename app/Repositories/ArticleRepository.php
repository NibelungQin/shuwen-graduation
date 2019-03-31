<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/3/26 0026
 * Time: 上午 10:03
 */

namespace App\Repositories;

use App\Model\Article;

/**
 * 帖子相关操作
 * Class ArticleRepository
 * @package App\Repositories
 */
class ArticleRepository
{
    /**
     * 获得所以分页帖子
     * @return mixed
     */
    public function getArticleFeed()
    {
        $articles =  Article::latest()->paginate(10);
        $articles->load(['user'=>function($query){
            return $query->select(['id','name','avatar']);
        },'topics']);
        return $articles;
    }

    /**
     * 创建帖子（新建数据到数据库）
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes)
    {
        return Article::create($attributes);
    }

    public function byId($id)
    {
        return Article::find($id);
    }

    public function byIdWithTopicAndUser($id)
    {
        $article = Article::where('id',$id)->first();
        $article->load(['user'=>function($query){
            return $query->select(['id','name','avatar']);
        },'topics','comments']);
        return $article;
    }
}