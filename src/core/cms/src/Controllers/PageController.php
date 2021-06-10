<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\Page;
use Cms\Requests\PageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Cms\Controllers\AppController;

class PageController extends AppController
{
    public function save(PageRequest $request, Page $page) {
        if($request->isMethod('post')) {

            $page->name            = $request->input('name');
            $page->name_url        = Str::of($request->input('name'))->slug('-');
            $page->content         = $request->input('content');
            $page->save();

            if($page->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.page.list')->with('success', $message);
        }
        return view('cms::auth.pages.page.form', compact('page'));
    }
}
