<?php

namespace App;

use App\Model\Answer;
use App\Model\Article;
use App\Model\Chat;
use App\Model\Comment;
use App\Model\Post;
use App\Model\Question;
use App\Model\Read;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens,Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'avatar', 'confirmation_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 进行用户与文章关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articleFollows()
    {
        return $this->belongsToMany(Article::class, 'user_article')->withTimeStamps();
    }

    /**
     * 进行用户与文章关联操作
     * @param $article
     * @return array
     */
    public function ArticleFollowThis($article)
    {
        return $this->articleFollows()->toggle($article);
    }

    /**
     * 判断用户是否关注文章
     * @param $article
     * @return bool
     */
    public function articleFollowed($article)
    {
        return !!$this->articleFollows()->where('article_id', $article)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function articleVotes()
    {
        return $this->belongsToMany(Article::class,'article_vote')->withTimestamps();
    }

    /**
     * @param $article
     * @return array
     */
    public function articleVoteFor($article)
    {
        return $this->articleVotes()->toggle($article);
    }

    /**
     * @param $article
     * @return bool
     */
    public function articleHasVotedFor($article)
    {
        return !!$this->articleVotes()->where('article_id', $article)->count();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questionVotes()
    {
        return $this->belongsToMany(Question::class,'question_vote')->withTimestamps();
    }

    /**
     * @param $article
     * @return array
     */
    public function questionVoteFor($article)
    {
        return $this->questionVotes()->toggle($article);
    }

    /**
     * @param $article
     * @return bool
     */
    public function questionHasVotedFor($article)
    {
        return !!$this->questionVotes()->where('question_id', $article)->count();
    }

    /**
     * 进行用户与问题关联
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(Question::class, 'user_question')->withTimeStamps();
    }

    /**
     * 进行用户与问题关联操作
     * @param $question
     * @return array
     */
    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    /**
     * 判断用户是否关注问题
     * @param $question
     * @return bool
     */
    public function followed($question)
    {
        return !!$this->follows()->where('question_id', $question)->count();
    }

    /**
     * 用户与回答关联表
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function votes()
    {
        return $this->belongsToMany(Answer::class,'votes')->withTimestamps();
    }

    /**
     * 进行用户与回答关联操作
     * @param $answer
     * @return array
     */
    public function voteFor($answer)
    {
        return $this->votes()->toggle($answer);
    }

    /**
     * 判断是否用户与回答已关联
     * @param $answer
     * @return bool
     */
    public function hasVotedFor($answer)
    {
        return !!$this->votes()->where('answer_id', $answer)->count();
    }

    /**
     * 用户关联其他用户
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function followers()
    {
        return $this->belongsToMany(self::class,'followers','follower_id','followed_id')->withTimestamps();
    }

    public function followersUser()
    {
        return $this->belongsToMany(self::class,'followers','followed_id','follower_id')->withTimestamps();
    }

    /**
     * 用户是否已关联其他用户
     * @param $user
     * @return array
     */
    public function followThisUser($user)
    {
        return $this->followers()->toggle($user);
    }

    /**
     * 用户与回答关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    /**
     * 用户与评论关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at','desc');
    }

    /**
     * 用户与浏览记录关联
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reads()
    {
        return $this->hasMany(Read::class,'user_id');
    }

    public function chats()
    {
        return $this->hasMany(Chat::class);
    }

    public function senders()
    {
        return $this->belongsToMany(self::class,'friends','sender_id','receiver_id')->withTimestamps();
    }

    public function receivers()
    {
        return $this->belongsToMany(self::class,'friends','receiver_id','sender_id')->withTimestamps();
    }

    public function acceptThisUser($user)
    {
        return $this->receivers()->toggle($user);
    }
}
