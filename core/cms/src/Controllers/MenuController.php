<?php

namespace Cms\Controllers;

use Cms\Constants;
use Cms\Controllers\AppController;
use Cms\Models\Menu;
use Cms\Requests\MenuRequest;
use Illuminate\Http\Request;

class MenuController extends AppController
{
    public function search(Request $request)
    {
        $searchList = Menu::getMenuList();
        $view = $this->getView();
        return [
            'search_result' => view($view . '.search_result', compact('searchList'))->render(),
            'pagination' => $searchList->links('cms::auth.components.pagination')->render(),
            'total' => 'Tổng cộng: ' . $searchList->total(),
        ];
    }

    public function save(MenuRequest $request, Menu $menu)
    {
        if ($request->isMethod('post')) {

            $menu->name = $request->input('name');
            $menu->url = $request->input('url');
            $menu->parent_menu_id = $request->input('parent_menu_id');
            $menu->type = $request->input('type');
            $menu->order = $request->input('order');
            $menu->status = Constants::STATUS_ACTIVE;
            $menu->target = $request->input('target');
            $menu->save();

            if ($menu->exists) {
                $message = trans('cms::auth.message.update_success');
            } else {
                $message = trans('cms::auth.message.create_success');
            }

            return redirect()->route('auth.menu.list')->with('success', $message);
        }
        $menuParents = Menu::query()->where('parent_menu_id', null)->get();
        return view('cms::auth.pages.menu.form', compact('menu', 'menuParents'));
    }

    public function updateOrder(Request $request)
    {
        $params = $request->only("update_orders");
        return \DB::transaction(function () use ($params) {
            if (!empty($params['update_orders'])) {
                foreach ($params['update_orders'] as $update_order) {
                    $menu = Menu::find($update_order['id']);
                    $menu->order = $update_order['order'];
                    $menu->save();
                }
            }
            return response()->json($params, 200);
        });
        
    }
}
