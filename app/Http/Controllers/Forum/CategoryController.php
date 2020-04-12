<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\ForumCategoryRepository;
use App\Repositories\ForumPostRepository;

class CategoryController extends BaseController
{
    /**
     * @var ForumCategoryRepository
     */
    private $forumCategoryRepository;

    /**
     * @var ForumPostRepository
     */
    private $forumPostRepository;


    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->forumCategoryRepository = app(ForumCategoryRepository::class);
        $this->forumPostRepository = app(ForumPostRepository::class);
    }

    /**
     * show parent category
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $answer['categories'] = $this->forumCategoryRepository->getCategoriesByParentId();
        $id = 1;

        return view('forum.start_page', compact('answer', 'id'));
    }

    /**
     * show subsidiary category by id
     *
     * @param  $id
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showSubsidiaryCategories($id)
    {
        $categories = $this->forumCategoryRepository->getCategoriesByParentId($id);
        $posts = $this->forumPostRepository->getPostsWithCategory($id);
        $answer = [
            'categories' => $categories,
            'posts' => $posts,
        ];

        return view('forum.start_page', compact('answer', 'id'));
    }
}
