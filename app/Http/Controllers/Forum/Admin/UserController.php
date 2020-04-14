<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->getAllWithPaginate(6);

        return view('forum.admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $item = new User();

        return view('forum.admin.users.user_edit', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(UserCreateRequest $request)
    {
        $data = $request->all();

        if (!empty($request->image)) {
            $path = $request->file('image')->store('uploads/user photo', 'public');
            $data['image'] = $path;
        }

        $item = (new User())->create($data);

        if ($item) {
            return redirect()
                ->route('forum.admin.users.edit', [$item->id])
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
        $item = $this->userRepository->getEditForAdmin($id);

        return view('forum.admin.users.user_edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $item = $this->userRepository->getEditForAdmin($id);

        $data = $request->all();

        if (!empty($request->image)) {
            $path = $request->file('image')->store('uploads/user photo', 'public');
            $data['image'] = $path;
        }

        $result = $item->update($data);

        if ($result) {
            return back()
                ->with(['success' => 'Успешно сохранено']);
        } else {
            return back()
                ->with(['success' => 'Ошибка сохранения'])
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
        $result = User::destroy($id);

        if ($result) {
            return redirect()
                ->route('forum.admin.users.index')
                ->with(['success' => 'Юзер id=[$id] удален']);
        } else {
            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }

    }
}
