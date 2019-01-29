<?php

namespace App;

use App\Model\Question;
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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function follows()
    {
        return $this->belongsToMany(Question::class, 'user_question')->withTimeStamps();
    }

    /**
     * @param $question
     * @return array
     */
    public function followThis($question)
    {
        return $this->follows()->toggle($question);
    }

    /**
     * @param $question
     * @return bool
     */
    public function followed($question)
    {
        return !!$this->follows()->where('question_id', $question)->count();
    }
}
