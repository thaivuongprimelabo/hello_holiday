<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\User;
use Cms\Requests\UserRequest;

use Illuminate\Http\Request;

class CmsController extends Controller
{
    //
    public function index() {
        return view('cms::auth.pages.dashboard.index');
    }

    public function listUser() {

        $users = User::query()->get();
        return view('cms::auth.pages.user.index', compact('users'));
    }

    public function createUser(UserRequest $request) {
        $user = new User();
        return view('cms::auth.pages.user.create', compact('user'));
    }
}
