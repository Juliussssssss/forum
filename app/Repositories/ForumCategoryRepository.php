<?php

namespace App\Repositories;

use App\Models\ForumCategory as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ForumCategoryRepository
 *
 * @package App\Repositories
 */
class ForumCategoryRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * Get panel for edit in admin
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
     * Get list of catigories for combox
     *
     * @return collection
     */
    public function getForCombobox()
    {
        $columns = implode(', ', [
            'id',
            'CONCAT (id, ". ", title) AS title_for_combobox'
        ]);

        $result = $this
            ->startConditions()
            ->selectRaw($columns)
            ->toBase()
            ->get();

        return $result;
    }

    /**get all categories with paginate
     *
     * @param int/null $perPage
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllWithPaginate($perPage = null)
    {
        $columns = ['id', 'title', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->with(['parentCategory:id,title'])
            ->paginate($perPage);

        return $result;
    }

    public function getCategoriesByParentId($id = 1)
    {
        $columns = ['id', 'title', 'description', 'parent_id'];

        $result = $this
            ->startConditions()
            ->select($columns)
            ->where('parent_id', $id)
            ->get();

        return $result;
    }

    public function getName($id)
    {
        return $this
            ->startConditions()
            ->select('title')
            ->where('id', $id)
            ->get()
            ->first();
    }

    public function getLike($string)
    {
        return $this
            ->startConditions()
            ->select('id', 'title', 'description')
            ->where('title', 'like', "%$string%")
            ->orWhere('description', 'like', "%$string%")
            ->paginate(15);
    }
}
