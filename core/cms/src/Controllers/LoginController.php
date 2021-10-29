<?php

namespace Cms\Controllers;

use App\Http\Controllers\Controller;
use Cms\Models\ActionHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    //
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {

            $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required'],
            ]);

            if (Auth::attempt($credentials)) {

                session_start();
                $_SESSION['ckfinder_auth'] = true;

                return redirect()->route('auth.dashboard');
            } else {
                return redirect()->route('auth.login')->withError(trans('cms::auth.failed'));
            }

        }
        ActionHistory::createHistory([
            'action' => Route::getCurrentRoute()->getActionName()
        ]);
        return view('cms::auth.pages.login.index');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        session_start();
        unset($_SESSION['ckfinder_auth']);

        ActionHistory::createHistory([
            'action' => Route::getCurrentRoute()->getActionName()
        ]);

        return redirect(route('auth.login'));
    }
}
