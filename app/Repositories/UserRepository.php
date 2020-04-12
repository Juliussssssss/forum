<?php

namespace App\Repositories;

use App\Models\User as Model;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class ForumCategoryRepository
 *
 * @package App\Repositories
 */
class UserRepository extends CoreRepository
{
    /**
     * @return string
     */
    protected function getModelClass()
    {
        return Model::class;
    }

   public function getUser($id)
   {
       $columns = [
           'id', 'name', 'email', 'created_at', 'email_verified_at', 'image'
       ];

       $result = $this
           ->startConditions()
           ->select($columns)
           ->where('id', $id)
           ->get()
           ->first();

       return $result;
   }

   public function getEdit($id)
   {
       $columns = [
           'id', 'name', 'email', 'image', 'email_verified_at', 'password'
       ];

       $result = $this
           ->startConditions()
           ->select($columns)
           ->where('id', $id)
           ->get()
           ->first();

       return $result;
   }

   public function getEditForAdmin($id)
   {
       return $this
           ->startConditions()
           ->where('id', $id)
           ->get()
           ->first();
   }

   public function getAllWithPaginate($id)
   {
       $columns = [
           'id', 'name', 'created_at', 'email_verified_at', 'image'
       ];
       return $this
           ->startConditions()
           ->select($columns)
           ->paginate($id);
   }
}
