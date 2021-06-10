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

            $user->name     = $request->input('name');

            if($request->has('email') && !empty($request->email)) {
                $user->email    = $request->input('email');
            }

            if($request->has('password') && !empty($request->password)) {
                $user->password = $request->input('password');
            }

            $user->phone    = $request->input('phone');
            $user->address  = $request->input('address');
            $user->status   = !is_null($request->input('status')) ? 1 : 0;
            
            $resultUpload = $this->uploadFile->upload($this->uploadSetting)->first();
            if(!empty($resultUpload)) {
                $user->avatar = $resultUpload;
            }
            
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
