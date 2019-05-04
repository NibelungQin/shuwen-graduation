<?php

namespace App\Http\Controllers;

use App\Repositories\AnswerRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\QuestionRepository;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    protected $answerRepository;
    protected $articleRepository;
    protected $questionRepository;

    public function __construct(AnswerRepository $answerRepository,ArticleRepository $articleRepository,QuestionRepository $questionRepository)
    {
        $this->answerRepository = $answerRepository;
        $this->articleRepository = $articleRepository;
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function voted($id)
    {
        if (user('api')->hasVotedFor($id)){
            return response()->json(['voted'=>true]);
        }
        return response()->json(['voted'=>false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function voteThisAnswer()
    {
        $answer = $this->answerRepository->byId(\request('answer'));
        $voted = user('api')->voteFor(\request('answer'));
        if (count($voted['attached'])>0){
            $answer->increment('votes_count');
            return response()->json(['voted'=>true]);
        }
        $answer->decrement('votes_count');
        return response()->json(['voted'=>false]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function articleVoted($id)
    {
        if (user('api')->articleHasVotedFor($id)){
            return response()->json(['voted'=>true]);
        }
        return response()->json(['voted'=>false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function voteThisArticle()
    {
        $article = $this->articleRepository->byId(\request('article'));
        $voted = user('api')->articleVoteFor(\request('article'));
        if (count($voted['attached'])>0){
            $article->increment('votes_count');
            return response()->json(['voted'=>true]);
        }
        $article->decrement('votes_count');
        return response()->json(['voted'=>false]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function questionVoted($id)
    {
        if (user('api')->questionHasVotedFor($id)){
            return response()->json(['voted'=>true]);
        }
        return response()->json(['voted'=>false]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function voteThisQuestion()
    {
        $question = $this->questionRepository->byId(\request('question'));
        $voted = user('api')->questionVoteFor(\request('question'));
        if (count($voted['attached'])>0){
            $question->increment('votes_count');
            return response()->json(['voted'=>true]);
        }
        $question->decrement('votes_count');
        return response()->json(['voted'=>false]);
    }
}
