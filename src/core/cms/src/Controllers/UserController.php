<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\User;
use Cms\Requests\UserRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Carbon;

class UserController extends Controller
{
    public function index() {
        return view('cms::auth.pages.user.index');
    }

    public function search(Request $request) {
        $query = User::query();
        $searchRequest = $request->all();

        if(isset($searchRequest['name_se']) && !is_null($searchRequest['name_se'])) {
            $query->where('name', 'LIKE', '%' . $searchRequest['name_se'] . '%');
        }

        if(isset($searchRequest['email_se']) && !is_null($searchRequest['email_se'])) {
            $query->where('email', 'LIKE', '%' . $searchRequest['email_se'] . '%');
        }

        if(isset($searchRequest['status_se']) && !is_null($searchRequest['status_se'])) {
            $query->where('status', $searchRequest['status_se']);
        }

        if(isset($searchRequest['date_from_se']) && !is_null($searchRequest['date_from_se'])) {
            $query->where('created_at', '>=', Carbon::parse($searchRequest['date_from_se'] . ' 00:00:00')->format('Y-m-d H:i:s'));
        }

        if(isset($searchRequest['date_to_se']) && !is_null($searchRequest['date_to_se'])) {
            $query->where('created_at', '<=', Carbon::parse($searchRequest['date_to_se'] . ' 23:59:00')->format('Y-m-d H:i:s'));
        }

        $users = $query->orderBy('created_at', 'desc')->paginate(6);
        return [
            'search_result' => view('cms::auth.pages.user.search_result', compact('users'))->render(),
            'pagination' => $users->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $users->total()
        ];
    }

    public function save(UserRequest $request, User $user) {
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
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.user.list')->with('success', $message);
        }
        return view('cms::auth.pages.user.form', compact('user'));
    }

    public function remove(Request $request) {
        $ids = $request->has('ids') ? $request->ids : [$request->user];

        User::query()->whereIn('id', $ids)->update([
            'status' => 0
        ]);

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }

    public function restore(Request $request) {
        $ids = $request->has('ids') ? $request->ids : [$request->user];

        User::query()->whereIn('id', $ids)->update([
            'status' => 1
        ]);

        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }
}
