<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\User;
use Cms\Requests\UserRequest;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Hash;

class UserController extends AppController
{

    public function save(UserRequest $request, User $user)
    {
        if ($request->isMethod('post')) {

            $user->name = $request->input('name');

            if ($request->has('email') && !empty($request->email)) {
                $user->email = $request->input('email');
            }

            if ($request->has('password') && !empty($request->password)) {
                $user->password = Hash::make($request->input('password'));
            }

            $user->phone = $request->input('phone');
            $user->address = $request->input('address');
            $user->status = !is_null($request->input('status')) ? 1 : 0;

            $resultUpload = $this->uploadFile->singleUpload('avatar');

            if (!empty($resultUpload)) {
                $user->avatar = $resultUpload;
            }

            $user->save();

            if ($user->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.user.list')->with('success', $message);
        }
        return view('cms::auth.pages.user.form', compact('user'));
    }
}
