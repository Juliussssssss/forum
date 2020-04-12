<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Http\Requests\ForumCategoryCreateRequest;
use App\Http\Requests\ForumCategoryUpdateRequest;
use App\Repositories\ForumCategoryRepository;
use Illuminate\Http\Request;
use App\Models\ForumCategory;

class CategoryController extends BaseController
{
    /**
     * @var ForumCategoryRepository
     */
    private $forumCategoryRepository;

    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        parent::__contruct();

        $this->forumCategoryRepository = app(ForumCategoryRepository::class);
    }

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->forumCategoryRepository->getAllWithPaginate(10);

        return view('forum.admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new ForumCategory();
        $categoryList = $this->forumCategoryRepository->getForCombobox();

        return view('forum.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ForumCategoryCreateRequest $request)
    {
        $data = $request->input();

        $item = (new ForumCategory())->create($data);

        if ($item) {
            return redirect()
                ->route('forum.admin.categories.edit', [$item->id])
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = $this->forumCategoryRepository->getEdit($id);

        if (empty($item)) {
            abort(404);
        }

        $categoryList = $this->forumCategoryRepository->getForCombobox();

        return view('forum.admin.categories.edit', compact('item', 'categoryList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ForumCategoryUpdateRequest $request, $id)
    {
        $item = $this->forumCategoryRepository->getEdit($id);

        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }
        $data = $request->all();

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->route('forum.admin.categories.edit', $item->id)
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = ForumCategory::destroy($id);

        if ($result) {
            return redirect()
                ->back()
                ->with(['success' => 'Категория id=[$id] удалена']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
