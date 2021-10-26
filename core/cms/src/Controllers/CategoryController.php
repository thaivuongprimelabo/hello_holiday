<?php

namespace Cms\Controllers;

use Cms\Controllers\AppController;
use Cms\Models\Category;
use Cms\Requests\CategoryRequest;

class CategoryController extends AppController
{

    public function save(CategoryRequest $request, Category $category)
    {
        if ($request->isMethod('post')) {

            $category->name = $request->name;
            $category->name_url = $this->slugName($category->name);
            $category->parent_id = $request->has('parent_id') ? $request->parent_id : null;
            $category->status = !is_null($request->status) ? 1 : 0;
            $category->save();

            if ($category->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.category.list')->with('success', $message);
        }

        $parentCategories = Category::query()->where('parent_id', null)->get();
        return view('cms::auth.pages.category.form', compact('category', 'parentCategories'));
    }

}
