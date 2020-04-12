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

    public function getEdit($id)
    {
        return $this
            ->startConditions()
            ->find($id);
    }
}
