<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Read extends Model
{
    protected $table = 'reads';
    protected $fillable = ['user_id','readable_id','readable_type','show_count'];

    /**
     * 将阅读记录与文章、问题关联
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function readable()
    {
        return $this->morphTo();
    }

}
