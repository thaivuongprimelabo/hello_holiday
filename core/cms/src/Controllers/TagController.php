<?php

namespace Cms\Controllers;

use Cms\Constants;
use Cms\Controllers\AppController;
use Cms\Models\ProductTag;
use Cms\Models\PostTag;
use Illuminate\Http\Request;

class TagController extends AppController
{

    public function search(Request $request)
    {
        $currentRoute = request()->route()->getName();
        $searchList = null;
        if (strpos($currentRoute, 'product') !== false) {
            $searchList = ProductTag::query()->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $searchList = PostTag::query()->orderBy('created_at', 'desc')->paginate(10);
        }

        $view = 'cms::auth.pages.tag';
        return [
            'search_result' => view($view . '.search_result', compact('searchList'))->render(),
            'pagination' => $searchList->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $searchList->total(),
        ];
    }

    public function saveProductTag(Request $request, ProductTag $tag)
    {
        if ($request->isMethod('post')) {
            $currentRoute = request()->route()->getName();
            $tag->name = $request->input('name');
            $tag->name_url = $this->slugName($tag->name);
            $tag->status = !is_null($request->status) ? Constants::STATUS_ACTIVE : Constants::STATUS_UNACTIVE;
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
        return view('cms::auth.pages.tag.form_product_tag', compact('tag'));
    }

    public function savePostTag(Request $request, PostTag $tag)
    {
        if ($request->isMethod('post')) {
            $currentRoute = request()->route()->getName();
            $tag->name = $request->input('name');
            $tag->name_url = $this->slugName($tag->name);
            $tag->status = !is_null($request->status) ? Constants::STATUS_ACTIVE : Constants::STATUS_UNACTIVE;
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
        return view('cms::auth.pages.tag.form_post_tag', compact('tag'));
    }

    public function remove(Request $request)
    {
        $currentRoute = request()->route()->getName();
        $ids = $request->ids;
        if (strpos($currentRoute, 'product') !== false) {
            ProductTag::query()->whereIn('id', $ids)->delete();
        } else {
            PostTag::query()->whereIn('id', $ids)->delete();
        }
        $message = trans('cms::auth.message.remove_success');

        return response()->json(['success' => $message]);
    }
}
