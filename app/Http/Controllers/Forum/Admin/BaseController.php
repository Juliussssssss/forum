<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Http\Controllers\Forum\BaseController as GuestBaseController;

class BaseController extends GuestBaseController
{
    /**
     * BaseController constructor.
     */
    public function __contruct()
    {

    }

    /**
     * show admin panel
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index() {
        return view('forum.admin.index');
    }
}
