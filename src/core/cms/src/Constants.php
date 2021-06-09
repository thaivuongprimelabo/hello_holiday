<?php
namespace Cms;

class Constants {

    public const STATUS_ACTIVE = 1;
    public const STATUS_UNACTIVE = 0;
    public const STATUS_DELETED = 2;

    public static $modelList = [
        'auth/category' => '\Cms\Models\Category',
        'auth/vendor' => '\Cms\Models\Vendor',
        'auth/user' => '\Cms\Models\User',
        'auth/product' => '\Cms\Models\Product',
        'auth/banner' => '\Cms\Models\Banner',
    ];

    public static $viewList = [
        'auth/category' => 'cms::auth.pages.category',
        'auth/vendor' => 'cms::auth.pages.vendor',
        'auth/user' => 'cms::auth.pages.user',
        'auth/product' => 'cms::auth.pages.product',
        'auth/banner' => 'cms::auth.pages.banner',
    ];

    public static $uploadSettingList = [
        'auth/user' => [
            'dir' => 'user'
        ],
        'auth/vendor' => [
            'dir' => 'vendor',
            'resize' => ['180x180']
        ],
        'auth/product' => [
            'dir' => 'product',
            'resize' => ['50x50', '160x160']
        ],
        'auth/banner' => [
            'dir' => 'banner'
        ],
    ];

}