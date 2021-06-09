<?php
namespace Cms;

class Constants {

    public const STATUS_ACTIVE = 1;
    public const STATUS_UNACTIVE = 0;
    public const STATUS_DELETED = 2;

    public const ORDER_STATUS_NEW = 0;
    public const ORDER_STATUS_DELIVERY = 1;
    public const ORDER_STATUS_FINISH = 2;
    public const ORDER_STATUS_CANCEL = 3;

    public const PAYMENT_METHOD_CASH = 'cash';
    public const PAYMENT_METHOD_BANK = 'banking';

    public static $orderStatusList = [
        ['id' => self::ORDER_STATUS_NEW, 'name' => 'ĐH mới'],
        ['id' => self::ORDER_STATUS_DELIVERY, 'name' => 'Đang giao hàng'],
        ['id' => self::ORDER_STATUS_FINISH, 'name' => 'Đã hoàn thành'],
        ['id' => self::ORDER_STATUS_CANCEL, 'name' => 'Đã huỷ'],
    ];

    public static $paymentMethodList = [
        ['id' => self::PAYMENT_METHOD_CASH, 'name' => 'Tiền mặt'],
        ['id' => self::PAYMENT_METHOD_BANK, 'name' => 'Chuyển khoản ngân hàng'],
    ];

    public static $modelList = [
        'auth/category' => '\Cms\Models\Category',
        'auth/vendor' => '\Cms\Models\Vendor',
        'auth/user' => '\Cms\Models\User',
        'auth/product' => '\Cms\Models\Product',
        'auth/banner' => '\Cms\Models\Banner',
        'auth/order' => '\Cms\Models\Order',
    ];

    public static $viewList = [
        'auth/category' => 'cms::auth.pages.category',
        'auth/vendor' => 'cms::auth.pages.vendor',
        'auth/user' => 'cms::auth.pages.user',
        'auth/product' => 'cms::auth.pages.product',
        'auth/banner' => 'cms::auth.pages.banner',
        'auth/order' => 'cms::auth.pages.order',
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