<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    protected $topicRepository;

    public function __construct(TopicRepository $topicRepository)
    {
        $this->topicRepository = $topicRepository;
    }

    /**
     * 获得标签栏搜索出现类似的标签
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        return $this->topicRepository->getTopicsForTagging($request);
    }
}
