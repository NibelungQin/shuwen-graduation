<?php

namespace App\Http\Controllers;

use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class QuestionFollowController extends Controller
{
    protected $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function follower()
    {
        $question = $this->questionRepository->byId(\request('question'));
        if (user('api')->followed($question->id)){
            return response()->json(['followed'=>true,'count'=>$question->followers_count]);
        }
        return response()->json(['followed'=>false,'count'=>$question->followers_count]);
    }

    public function followThisQuestion()
    {
        $question = $this->questionRepository->byId(\request('question'));
        $followed = user('api')->followThis($question->id);
        if (count($followed['detached'])>0){
            $question->decrement('followers_count');
            return response()->json(['followed'=>false,'count'=>$question->followers_count]);
        }
        $question->increment('followers_count');
        return response()->json(['followed'=>true,'count'=>$question->followers_count]);
    }
}
