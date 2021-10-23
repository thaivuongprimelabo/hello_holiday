<?php

namespace Cms\Models;

use Cms\Constants;
use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory, AppModel;

    public function childMenus() {
        return $this->hasMany(Menu::class, 'parent_menu_id', 'id');
    }

    public static function getMenuList($list = false, $frontend = false) {
        $query = self::query()->with(['childMenus' => function($subQuery) use ($frontend) {
            if ($frontend) {
                $subQuery->where('status', Constants::STATUS_ACTIVE);
            }
            $subQuery->orderBy('order', 'asc');
        }]);

        if ($frontend) {
            $query->where('parent_menu_id', null)->where('status', Constants::STATUS_ACTIVE)->orderBy('order', 'asc');
        } else {
            $query->where('parent_menu_id', null)->orderBy('order', 'asc');
        }

        return $list ? $query->get() : $query->paginate(100);
    }

}
