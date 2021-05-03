<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\User;
use Cms\Requests\UserRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listUser(Request $request) {
        return view('cms::auth.pages.user.index');
    }

    public function search(Request $request) {
        $query = User::query();
        $keyword = $request->keyword;
        if($keyword) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
            $query->orWhere('email', 'LIKE', '%' . $keyword . '%');
        }
        $users = $query->orderBy('created_at', 'desc')->paginate(6);
        return [
            'search_result' => view('cms::auth.pages.user.search_result', compact('users'))->render(),
            'pagination' => $users->links('cms::auth.components.pagination')->render()
        ];
    }

    public function saveUser(UserRequest $request, User $user) {
        if($request->isMethod('post')) {

            $user->name     = $request->name;
            $user->password = $request->password;
            $user->avatar   = $request->current_avatar;

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
                $message = trans('auth.message.update_success');
            } else {
                $message = trans('auth.message.create_success');
            }

            return redirect()->route('auth.user.list')->with('success', $message);
        }
        return view('cms::auth.pages.user.form', compact('user'));
    }
}
