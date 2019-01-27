<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $table = 'topics';
    protected $fillable = ['name','bio','questions_count'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function questions()
    {
        return $this->belongsToMany(Question::class)->withTimestamps();
    }
}
