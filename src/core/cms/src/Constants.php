<?php
namespace Cms;

class Constants
{

    public const STATUS_ACTIVE = 1;
    public const STATUS_UNACTIVE = 0;
    public const STATUS_DELETED = 2;

    public const ORDER_STATUS_NEW = 0;
    public const ORDER_STATUS_DELIVERY = 1;
    public const ORDER_STATUS_FINISH = 2;
    public const ORDER_STATUS_CANCEL = 3;

    public const CONTACT_NEW = 0;
    public const CONTACT_REPLIED = 1;

    public const PAYMENT_METHOD_CASH = 'cash';
    public const PAYMENT_METHOD_BANK = 'banking';

    public const MAX_UPLOAD_LOGO = 200;
    public const MAX_UPLOAD_BANNER = 500;
    public const MAX_UPLOAD_PRODUCT = 500;
    public const MAX_UPLOAD_PHOTO = 200;
    public const MAX_UPLOAD_AVATAR = 200;
    public const MAX_UPLOAD_WEB_LOGO = 200;
    public const MAX_UPLOAD_WEB_ICO = 200;
    public const MAX_UPLOAD_WEB_BANNER = 500;

    public static $maxUpload = [
        'logo'          => self::MAX_UPLOAD_LOGO,
        'banner'        => self::MAX_UPLOAD_BANNER,
        'image_product' => self::MAX_UPLOAD_PRODUCT,
        'photo'         => self::MAX_UPLOAD_PHOTO,
        'avatar'        => self::MAX_UPLOAD_AVATAR,
        'web_logo'      => self::MAX_UPLOAD_WEB_LOGO,
        'web_ico'       => self::MAX_UPLOAD_WEB_ICO,
        'web_banner'    => self::MAX_UPLOAD_WEB_BANNER,
    ];

    public static $maxUploadText = [
        'logo'          => '200 KB',
        'banner'        => '500 KB',
        'image_product' => '500 KB',
        'photo'         => '200 KB',
        'avatar'        => '200 KB',
        'web_logo'      => '200 KB',
        'web_ico'       => '200 KB',
        'web_banner'    => '500 KB',
    ];

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

    public static $statusList = [
        ['id' => self::STATUS_ACTIVE, 'name' => 'Đang hoạt động'],
        ['id' => self::STATUS_UNACTIVE, 'name' => 'Tạm dừng'],
    ];

    public static $uploadSettingList = [];

}
