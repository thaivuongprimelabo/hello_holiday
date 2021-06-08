<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\User;
use Cms\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;
use Cms\Controllers\AppController;

class UserController extends AppController
{

    public function save(UserRequest $request, User $user) {
        if($request->isMethod('post')) {

            $user->name     = $request->name;
            $user->avatar   = $request->current_avatar;

            if($request->has('email') && !empty($request->email)) {
                $user->email    = $request->email;
            }

            if($request->has('password') && !empty($request->password)) {
                $user->password = $request->password;
            }
            
            $user->status   = !is_null($request->status) ? 1 : 0;

            $user->avatar   = $this->uploadFile->upload($this->uploadSetting);
            
            $user->save();

            if($user->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.user.list')->with('success', $message);
        }
        return view('cms::auth.pages.user.form', compact('user'));
    }
}
