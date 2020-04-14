<?php

namespace App\Repositories;

use App\Models\ForumComment as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ForumCategoryRepository
 *
 * @package App\Repositories
 */
class ForumCommentRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * get all post comments
     *
     * @param $id
     * @return mixed
     */
    public function getComments($id)
    {
        $columns = [
            'post_id_answer', 'comment', 'is_published', 'user_id', 'created_at', 'updated_at', 'id'
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('is_published', 1)
            ->where('post_id', $id)
            ->with('user', 'commentAnswer')
            ->get();

        return $result;
    }

    /**
     * get editing data
     *
     * @param $id
     * @return mixed
     */
    public function getEdit($id)
    {
        return $this
            ->startConditions()
            ->find($id);
    }

    /**
     * check owner comments
     *
     * @param $id
     * @return bool
     */
    public function owner($id)
    {
        $owner = $this
            ->startConditions()
            ->select('user_id')
            ->where('id', $id)
            ->get()
            ->first();

        if($owner->user_id == auth()->user()->id || auth()->user()->is_admin == 1) {
            return true;
        } else {
            return false;
        }
    }
}
