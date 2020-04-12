<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForumCommentCreateRequest;
use App\Http\Requests\ForumCommentUpdateRequest;
use App\Repositories\ForumCommentRepository;
use Illuminate\Http\Request;
use App\Models\ForumComment;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    /**
     * @var ForumCommentRepository
     */
    private $forumCommentRepository;


    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->forumCommentRepository = app(ForumCommentRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        dd(__METHOD__);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        dd(__METHOD__);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ForumCommentCreateRequest $request)
    {
        $data = $request->input();

        $item = (new ForumComment())->create($data);

        if ($item) {
            return back()
                ->withErrors(['msg' => 'Ошибка сохранения'])
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
        dd(__METHOD__);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ForumCommentUpdateRequest $request, $id)
    {
        $item = $this->forumCommentRepository->getEdit($id);
        if ($item->user_id != Auth::user()->id) {
            return  abort(403, 'Доступ запрещен');
        }
        if (empty($item)) {
            return back()
                ->withErrors(['msg' => "Запись id=[{$id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $result = $item->update($data);

        if ($result) {
            return redirect()
                ->back()
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
        $result = ForumComment::destroy($id);

        if ($result) {
            return back()->with(['success' => 'Запись удалена']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }
    }
}
