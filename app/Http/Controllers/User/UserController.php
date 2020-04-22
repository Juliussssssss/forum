<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    private $userRepository;


    /**
     * CategoryController constructor.
     */
    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $user = $this->userRepository->getUser(auth()->user()->id);

        return view('forum.user.profile.user_info', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->id == $id) {
            $user = $this->userRepository->getUser($id);

            return view('forum.user.profile.change_data', compact('user'));
        } else {

            return  abort(403, 'Доступ запрещен');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $item = $this->userRepository->getEdit($id);

        $data = $request->all();

        if (!empty($request->image)) {
            $path = $request->file('image')->store('uploads\userPhoto', 'public');
            $data['image'] = $path;
        }

        $result = $item->update($data);

        if ($result) {

            return redirect()
                ->route('user.index')
                ->with(['success' => 'Успешно сохранено']);
        } else {

            return back()
                ->withInput();
        }
    }
}
