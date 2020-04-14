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
     * @param $id
     * @return mixed
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

    /**
     * get all posts for start_page
     *
     * @param $id
     * @return mixed
     */
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
            'title', 'id', 'user_id', 'published_at'
        ];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('category_id', $id)
            ->with('category', 'user')
            ->paginate(15);

        return $result;
    }

    /**
     * get a post to display for the user
     *
     * @param null $id
     * @return mixed
     */
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

    /**
     * Get search result
     *
     * @param $string
     * @return mixed
     */
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

    /**
     * check post owner
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
