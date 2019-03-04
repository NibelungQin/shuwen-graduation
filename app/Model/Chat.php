<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = ['user_id','message'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
