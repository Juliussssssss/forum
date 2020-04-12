<?php

namespace App\Http\Controllers\Forum\Admin;

use App\Http\Controllers\Forum\BaseController as GuestBaseController;

class BaseController extends GuestBaseController
{
    public function __contruct()
    {

    }

    public function index() {
        return view('forum.admin.index');
    }
}
