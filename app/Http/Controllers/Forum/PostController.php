<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForumPostCreateRequest;
use App\Http\Requests\ForumPostUpdateRequest;
use App\Models\ForumPost;
use App\Repositories\ForumCommentRepository;
use App\Repositories\ForumCategoryRepository;
use App\Repositories\ForumPostRepository;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * @var ForumPostRepository
     */
    private $forumPostRepository;

    /**
     * @var ForumCommentRepository
     */
    private $forumCommentRepository;

    /**
     * @var ForumCategoryRepository
     */
    private $forumCategoryRepository;


    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->forumPostRepository = app(ForumPostRepository::class);
        $this->forumCommentRepository = app(ForumCommentRepository::class);
        $this->forumCategoryRepository = app(ForumCategoryRepository::class);

        $this->middleware('auth')->only('show');
        $this->middleware(['auth', 'verified'])->only('edit', 'update', 'create', 'store', 'destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
       $posts = $this->forumPostRepository->getAllWithPaginateForUser(auth()->user()->id);

       return view('forum.user.profile.posts_list', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $category_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create($category_id)
    {
        $item = new ForumPost();@
        $categoryName = $this->forumCategoryRepository->getNameCategory($category_id);

        return view('forum.user.posts.post_add', compact('item', 'categoryName', 'category_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ForumPostCreateRequest $request)
    {
        $data = $request->input();

        $item = (new ForumPost())->create($data);

        if ($item->exists) {

            return redirect()
                ->route('forum.post.show', $item->id)
                ->with(['success' => 'Успешно добавленно']);
        } else {

            return back()->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $post = $this->forumPostRepository->getPost($id);
        $comments = $this->forumCommentRepository->getComments($id);

        return view('forum.user.posts.post', compact('post', 'comments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $item = $this->forumPostRepository->getEdit($id);

        if (!($this->forumPostRepository->owner($id))) {

            return  abort(403, 'Доступ запрещен');
        } elseif (empty($item)) {
            abort(404);
        }

        return view('forum.user.posts.post_add', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ForumPostUpdateRequest $request, $id)
    {
        $item = $this->forumPostRepository->getEdit($id);
        $data = $request->all();

        if ($this->forumPostRepository->Owner($id)) {
            $result = $item->update($data);

            if ($result) {

                return redirect()
                    ->route('forum.post.show', $item->id)
                    ->with(['success' => 'Успешно сохранено']);
            } else {

                return back()
                    ->withErrors(['msg' => 'Ошибка сохранения'])
                    ->withInput();
            }
        }

        return abort(403, 'Доступ запрещен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        if ($this->forumPostRepository->Owner($id)) {
            $result = ForumPost::destroy($id);
            if ($result) {
                return redirect()
                    ->route('forum.categories')
                    ->with(['success' => 'Запись удалена']);
            } else {
                return redirect()
                    ->route('forum.categories')
                    ->withErrors(['msg' => 'Ошибка удаления']);
            }
        }

            return abort(403, 'Доступ запрещен');
    }
}
