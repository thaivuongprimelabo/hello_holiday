<?php

namespace Cms\Controllers;

use Cms\Constants;
use Cms\Controllers\AppController;
use Cms\Models\Tag;
use Illuminate\Http\Request;

class TagController extends AppController
{

    public function search(Request $request)
    {
        $currentRoute = request()->route()->getName();
        $searchList = Tag::query();
        if (strpos($currentRoute, 'product') !== false) {
            $searchList = $searchList->productTag()->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $searchList = $searchList->postTag()->orderBy('created_at', 'desc')->paginate(10);
        }

        $view = 'cms::auth.pages.tag';
        return [
            'search_result' => view($view . '.search_result', compact('searchList'))->render(),
            'pagination' => $searchList->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $searchList->total(),
        ];
    }

    public function save(Request $request, Tag $tag)
    {
        if ($request->isMethod('post')) {
            $currentRoute = request()->route()->getName();
            $type = 'post';
            if (strpos($currentRoute, 'product') !== false) {
                $type = 'product';
            }
            $tag->name = $request->input('name');
            $tag->slug = $this->slugName($tag->name);
            $tag->status = !is_null($request->status) ? Constants::STATUS_ACTIVE : Constants::STATUS_UNACTIVE;
            $tag->type = $type;
            $tag->save();

            if ($tag->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            $listRoute = str_replace('create', 'list', $currentRoute);
            $listRoute = str_replace('edit', 'list', $listRoute);
            return redirect()->route($listRoute)->with('success', $message);
        }
        $tag->status = $tag->exists ? $tag->status : Constants::STATUS_ACTIVE;
        return view('cms::auth.pages.tag.form', compact('tag'));
    }
}
