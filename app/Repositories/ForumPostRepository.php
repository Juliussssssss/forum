<?php

namespace App\Repositories;

use App\Models\ForumPost as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ForumCategoryRepository
 *
 * @package App\Repositories
 */
class ForumPostRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * get all posts in admonostration with paginate
     *
     * @return LengthAwarePaginator
     */
    public function getAllWithPaginate($id) {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->with('category', 'user')
            ->paginate($id);

        return $result;
    }

    public function getAllWithPaginateForUser($id) {
        $columns = [
            'id',
            'title',
            'slug',
            'is_published',
            'published_at',
            'user_id',
            'category_id'
        ];

        $result = $this->startConditions()
            ->select($columns)
            ->orderBy('id', 'DESC')
            ->where('user_id', $id)
            ->with('category', 'user')
            ->paginate(5);

        return $result;
    }

    /**
     * get model for edit
     *
     * @param int $id
     *
     * @return Model
     */
    public function getEdit($id)
    {
        return $this
            ->startConditions()
            ->find($id);
    }

    /**
     * get post by category id for list posts
     *
     * @param int $id
     *
     * @return mixed
     */
    public function getPostsWithCategory($id = 1)
    {
        $columns = [
            'title', 'id', 'user_id'
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('category_id', $id)
            ->with('category', 'user')
            ->paginate(5);

        return $result;
    }

    public function getPost($id = null)
    {
        $columns = [
            'title' ,'published_at' , 'user_id', 'category_id', 'id', 'updated_at', 'content_row'
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with('category', 'user')
            ->where('id', $id)
            ->get()
            ->first();

        return $result;
    }

    public function getLike($string)
    {
        return $this
            ->startConditions()
            ->select('id', 'title', 'user_id', 'published_at')
            ->orderBy('published_at', 'DESC')
            ->where('title', 'like', "%$string%")
            ->with('category', 'user')
            ->paginate(15);
    }

    public function Owner($id)
    {
        $owner = $this
            ->startConditions()
            ->select('user_id')
            ->where('id', $id)
            ->get()
            ->first();

        if($owner->user_id == auth()->user()->id) {
            return true;
        } else {
            return false;
        }

    }
}
