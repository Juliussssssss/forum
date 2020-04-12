<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumPost extends Model
{
    use SoftDeletes;

    const UNKNOWN_USER = 1;

    protected $fillable =
        [
            'title',
            'slug',
            'category_id',
            'excerpt',
            'content_row',
            'is_published',
            'published_at'
        ];
    /**
     * category of post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(ForumCategory::class);
    }

    /**
     * author of tht post
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
