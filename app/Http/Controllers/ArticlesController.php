<?php

namespace App\Http\Controllers;

use App\Http\Resources\ArticleResource;
use App\Repositories\ArticleRepository;
use App\Repositories\ReadRepository;
use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    protected $topicRepository;
    protected $articleRepository;
    protected $readRepository;

    public function __construct(TopicRepository $topicRepository,
                                ArticleRepository $articleRepository,
                                ReadRepository $readRepository)
    {
        $this->topicRepository = $topicRepository;
        $this->articleRepository = $articleRepository;
        $this->readRepository = $readRepository;
    }

    /**
     * 帖子分页显示
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $articles = $this->articleRepository->getArticleFeed();
        return ArticleResource::collection($articles);
    }

    /**
     * 创建帖子
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        //将新增的标签加入数据库并返回id
        $topics = $this->topicRepository->normalizeTopic(\request('topics'));
        $data = [
            'title' => \request('title'),
            'content' => \request('content'),
            'image' => \request('image'),
            'description' => \request('description'),
            'user_id' => user('api')->id,
            'is_original' => \request('is_original'),
            'published_at' => \request('published_at'),
        ];
        //创建新帖子
        $article = $this->articleRepository->create($data);
        //帖子与标签关联
        $article->topics()->attach($topics);
        return response()->json([
            'status' => true,
            'msg'    => '帖子创建成功'
        ],200);
    }

    /**
     * 显示帖子详情
     * @param $id
     * @return mixed
     */
    public function show($id)
    {
        $article = $this->articleRepository->byIdWithTopicAndUser($id);
        $this->readRepository->store($id,'App\Model\Article');
        return $article;
    }

    /**
     * 修改帖子
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id)
    {
        $article = $this->articleRepository->byId($id);
        $topics = $this->topicRepository->normalizeTopic(\request('topics'));
        $data = [
            'title' => \request('title'),
            'content' => \request('content'),
            'image' => \request('image'),
            'description' => \request('description'),
            'is_original' => \request('is_original'),
            'published_at' => \request('published_at'),
        ];
        $article->update($data);
        $article->topics()->sync($topics);
        return response()->json([
            'status' => true,
            'msg'    => '帖子修改成功'
        ],200);
    }

    /**
     * 删除帖子
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $article = $this->articleRepository->byId($id);
        $article->delete();
        return response()->json([
            'status'  => true,
            'message' => '帖子删除成功'
        ],200);
    }
}
