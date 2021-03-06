<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $fillable = ['title','content','image','description','user_id','is_original','published_at','last_user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class);
    }

    public function comments()
    {
        return $this->morphMany('App\Model\Comment', 'commentable');
    }

    public function reads()
    {
        return $this->morphMany(Read::class, 'readable');
    }
}
