<?php

namespace App\Http\Controllers;

use App\Http\Resources\QuestionResource;
use App\Model\Article;
use App\Model\Question;
use App\Model\Read;
use App\Repositories\ArticleRepository;
use App\Repositories\QuestionRepository;
use App\Repositories\ReadRepository;
use Illuminate\Http\Request;

/**
 * 首页显示
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    protected $readRepository;
    protected $articleRepository;
    protected $questionRepository;

    public function __construct(ReadRepository $readRepository,ArticleRepository $articleRepository,QuestionRepository $questionRepository)
    {
        $this->readRepository = $readRepository;
        $this->articleRepository = $articleRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * 首页轮播图
     * @return \Illuminate\Http\JsonResponse
     */
    public function carousel()
    {
        $articles = Article::latest('created_at')->take(6)->get();
        return response()->json($articles);
    }

    /**
     * 判断用户是否有浏览记录，若有则询问是否显示之前浏览的内容
     * @return \Illuminate\Http\JsonResponse
     */
    public function readLog()
    {
        $read = $this->readRepository->readLog();
        $read->readable;
        if ($read){
            if ($read->show_count < 1){
                $read->update(['show_count'=>1]);
                $read['type'] = class_basename($read['readable_type']);
                return response()->json([
                    'status' => true,
                    'message' => '有最新的阅读记录',
                    'read' => $read
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => '最新的阅读记录已阅读过',
                'read' => ''
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => '没有最新的阅读记录',
            'read' => ''
        ]);
    }


    public function articles()
    {
        $articles = $this->articleRepository->homeArticles();
        return response()->json($articles);
    }

    public function questions()
    {
        $questions = $this->questionRepository->homeQuestions();
        return response()->json($questions);
    }

    /**
     * 推荐
     */
    public function recommend()
    {
        $articles = Article::orderBy('view_count','desc')->take(3)->get();
        $question = Question::orderBy('view_count','desc')->take(3)->get();
        return response()->json([
            'articles' => $articles,
            'questions' => $question
        ]);
    }

    /**
     * 浏览记录
     */
    public function reads()
    {
        $user_id = user('api')->id;
        $reads = Read::where('user_id',$user_id)->with('readable')->take(6)->get();
        $reads = collect($reads)->map(function ($read){
           $read['type'] = class_basename($read['readable_type']);
           $read['created_diff'] = $read->updated_at->diffForHumans();
           return $read;
        });
        return response()->json($reads);
    }
}
