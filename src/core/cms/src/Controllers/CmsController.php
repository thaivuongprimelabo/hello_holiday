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
        $users = User::query()->orderBy('created_at', 'desc')->paginate(6);
        return view('cms::auth.pages.user.index', compact('users'));
    }

    public function saveUser(UserRequest $request, User $user) {
        if($request->isMethod('post')) {

            $user->name     = $request->name;
            $user->password = $request->password;

            if(!$user->exists) {
                $user->email    = $request->email;
            }
            
            $user->status   = !is_null($request->status) ? 1 : 0;

            if($request->has('avatar')) {
                $filename = $request->file('avatar')->getClientOriginalName();
                $uploadPath = 'cms/upload/';
                $uploadDir = public_path($uploadPath);
                $avatar = $request->file('avatar')->move($uploadDir, $filename);
                $user->avatar   = $uploadPath . $filename;
            }
            
            $user->save();

            if($user->exists) {
                $message = 'Cập nhật thành công';
            } else {
                $message = 'Đăng ký thành công';
            }

            return redirect()->route('auth.user.list')->with('success', $message);
        }
        return view('cms::auth.pages.user.form', compact('user'));
    }
}
