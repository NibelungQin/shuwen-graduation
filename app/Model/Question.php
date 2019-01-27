<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['title', 'body', 'user_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function topics()
    {
        return $this->belongsToMany(Topic::class)->withTimestamps();
    }
}
