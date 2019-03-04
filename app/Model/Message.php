<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = ['from_user_id', 'to_user_id', 'body', 'dialog_id'];

    public function fromUser()
    {
        return $this->belongsTo(User::class,'from_user_id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class,'to_user_id');
    }

    public function markAsRead()
    {
        if (is_null($this->read_at)){
            $this->forceFill(['has_read'=>'T','read_at'=>$this->freshTimestamp()])->save();
        }
    }

    public function read()
    {
        return $this->read_at === 'T';
    }

    public function unread()
    {
        return $this->read_at === 'F';
    }

    public function shouldAddUnreadClass()
    {
        if (\user('api')->id === $this->from_user_id){
            return false;
        }
        return $this->unread();
    }
}
