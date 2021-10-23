<?php

namespace Cms\Models;

use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory, AppModel;

    public function childMenus() {
        return $this->hasMany(Menu::class, 'parent_menu_id', 'id');
    }

    public static function getMenuList($list = false) {
        $query = self::query()->with(['childMenus' => function($query) {
            $query->orderBy('order', 'asc');
        }])->where('parent_menu_id', null)->orderBy('order', 'asc');

        return $list ? $query->get() : $query->paginate(100);
    }

}
