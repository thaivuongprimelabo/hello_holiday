<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function index(Request $request) {
        if ($request->isMethod('post')) {

            $credentials = $request->validate([
                'email' => ['required'],
                'password' => ['required']
            ]);

            if (Auth::attempt($credentials)) {
    
                return redirect()->route('auth.dashboard');
            } else {
                return redirect()->route('auth.login')->withError(trans('cms::auth.failed'));
            }
           
        }
        return view('cms::auth.pages.login.index');
    }

    public function logout(Request $request) {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect(route('auth.login'));
    }
}
