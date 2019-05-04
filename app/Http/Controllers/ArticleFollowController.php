<?php

namespace App\Http\Controllers;

use App\Repositories\ArticleRepository;
use Illuminate\Http\Request;

class ArticleFollowController extends Controller
{
    protected $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function follower()
    {
        $article = $this->articleRepository->byId(\request('article'));
        if (user('api')->articleFollowed($article->id)){
            return response()->json(['followed'=>true,'count'=>$article->followers_count]);
        }
        return response()->json(['followed'=>false,'count'=>$article->followers_count]);
    }

    public function followThisArticle()
    {
        $article = $this->articleRepository->byId(\request('article'));
        $followed = user('api')->ArticleFollowThis($article->id);
        if (count($followed['detached'])>0){
            $article->decrement('followers_count');
            return response()->json(['followed'=>false,'count'=>$article->followers_count]);
        }
        $article->increment('followers_count');
        return response()->json(['followed'=>true,'count'=>$article->followers_count]);
    }
}
