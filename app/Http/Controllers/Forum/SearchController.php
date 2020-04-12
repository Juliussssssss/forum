<?php

namespace App\Http\Controllers\forum;

use App\Http\Controllers\Controller;
use App\Repositories\ForumCategoryRepository;
use App\Repositories\ForumPostRepository;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    protected $forumPostRepository;
    protected $forumCategoriesRepository;

    public function __construct()
    {
        $this->forumPostRepository = app(ForumPostRepository::class);
        $this->forumCategoriesRepository = app(ForumCategoryRepository::class);
    }

    public function __invoke(Request $request)
    {
        $search = ($request->search);
        $posts = $this->forumPostRepository->getLike($search);
        $categories = $this->forumCategoriesRepository->getLike($search);
        $answer = [
            'posts' => $posts,
            'categories' => $categories,
            'search' => $search
        ];

        return view('search_result', compact( 'answer'));
    }
}
