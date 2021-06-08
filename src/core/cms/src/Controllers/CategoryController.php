<?php

namespace Cms\Controllers;
use App\Http\Controllers\Controller;
use Cms\Models\Category;
use Cms\Requests\CategoryRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Cms\Controllers\AppController;

class CategoryController extends AppController
{

    public function save(CategoryRequest $request, Category $category) {
        if($request->isMethod('post')) {

            $category->name     = $request->name;
            $category->name_url = Str::of($request->name)->slug('-');
            $category->parent_id = $request->has('parent_id') ? $request->parent_id : 0;
            $category->parent_parent_id = $request->has('parent_parent_id') ? $request->parent_parent_id : 0;
            $category->status   = !is_null($request->status) ? 1 : 0;
            $category->save();

            if($category->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.category.list')->with('success', $message);
        }
        return view('cms::auth.pages.category.form', compact('category'));
    }

}
