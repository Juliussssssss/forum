<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumComment extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'user_id',
            'post_id',
            'post_id_answer',
            'comment',
        ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function commentAnswer()
    {
        return $this->belongsTo(ForumComment::class, 'post_id_answer','id' );
    }
}
