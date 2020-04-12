<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ForumCategory extends Model
{
    use SoftDeletes;

    protected $fillable =
        [
            'title',
            'slug',
            'parent_id',
            'description'
        ];

    public function parentCategory()
    {
        return $this->belongsTo(ForumCategory::class, 'parent_id','id');
    }

}
