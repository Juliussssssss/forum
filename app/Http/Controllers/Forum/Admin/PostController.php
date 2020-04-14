<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Http\Requests\ForumPostCreateRequest;
use App\Http\Requests\ForumPostUpdateRequest;
use App\Models\ForumPost;
use App\Repositories\ForumCategoryRepository;
use App\Repositories\ForumPostRepository;

class  PostController extends BaseController
{
    /**
     * @var ForumPostRepository
     */
    private $forumPostRepository;

    /**
     * @var ForumCategoryRepository
     */
    private $forumCategoryRepository;

    /**
     * PostController constructor.
     */
    public function __construct()
    {
        parent::__contruct();

        $this->forumCategoryRepository = app(ForumCategoryRepository::class);
        $this->forumPostRepository = app(ForumPostRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $posts = $this->forumPostRepository->getAllWithPaginate(15);

        return view('forum.admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $item = new ForumPost();
        $categoryList = $this->forumCategoryRepository->getForCombobox();

        return view('forum.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ForumPostCreateRequest  $request
     *
     * @return \Illuminate\Http\RedirectResponse;
     */
    public function store(ForumPostCreateRequest $request)
    {
        $data = $request->input();
        $item = (new ForumPost())->create($data);

        if ($item) {
            return redirect()
                ->route('forum.admin.posts.edit', [$item->id])
                ->with(['success' => 'Успешно добавленно']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->forumCategoryRepository->getForCombobox();

        return view('forum.admin.posts.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ForumPostUpdateRequest $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse;
     */
    public function update(ForumPostUpdateRequest $request, $id)
    {
        $item = $this->forumPostRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();
        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('forum.admin.posts.edit', $item->id)
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $result = ForumPost::destroy($id);

        if ($result) {
            return redirect()
                ->back()
                ->with(['success' => 'Запись id=[$id] удалена']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
