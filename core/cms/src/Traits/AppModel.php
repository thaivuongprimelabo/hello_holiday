<?php
namespace Cms\Traits;

use Cms\Constants;
use Illuminate\Support\Carbon;
use Web\Helpers\Utils;

trait AppModel
{

    public function scopeActive()
    {
        return $this->where('status', Constants::STATUS_ACTIVE);
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return !is_null($this->price) && $this->price ? Utils::formatCurrency($this->price) : 'Liên hệ';
    }

    public function getOriginPrice()
    {
        return $this->price;
    }

    public function getOriginDiscountPrice()
    {
        return $this->price - ($this->price * ($this->discount / 100));
    }

    public function getDiscountPrice()
    {
        $discount = $this->price - ($this->price * ($this->discount / 100));
        return Utils::formatCurrency($discount);
    }

    public function getCost()
    {
        return $this->cost ? Utils::formatCurrency($this->cost) . ' đ' : 'Liên hệ';
    }

    public function getCreatedAt()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y H:i:s');
    }

    public function getUpdatedAt()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->updated_at)->format('d-m-Y H:i:s');
    }

    public function getLastLogin()
    {
        if (is_null($this->last_login)) {
            return '';
        }
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->last_login)->format('d-m-Y H:i:s');
    }

    public function getStatusText()
    {

        if ($this->status == Constants::STATUS_UNACTIVE) {
            return '<span class="tag tag-danger text-danger">Tạm dừng</span>';
        }

        if ($this->status == Constants::STATUS_ACTIVE) {
            return '<span class="tag tag-success text-success">Đang hoạt động</span>';
        }

        if ($this->status == Constants::STATUS_DELETED) {
            return '<span class="tag tag-success text-danger">Đã xoá</span>';
        }
    }

    public function getProductImage()
    {
        if (!is_null($this->imagesProduct()->first())) {
            return $this->imagesProduct()->first()->getMediumImage();
        }
        return $this->getDefaultImage();
    }

    public function getMediumImage()
    {
        $file = public_path($this->medium);
        if (!is_null($this->medium) && !empty($this->medium) && file_exists($file)) {
            return asset($this->medium);
        }
        return $this->getDefaultImage();
    }

    public function getSmallImage()
    {
        $file = public_path($this->small);
        if (!is_null($this->small) && !empty($this->small) && file_exists($file)) {
            return asset($this->small);
        }
        return $this->getDefaultImage();
    }

    public function getLargeImage()
    {
        $file = public_path($this->image);
        if (!is_null($this->image) && !empty($this->image) && file_exists($file)) {
            return asset($this->image);
        }
        return $this->getDefaultImage();
    }

    public function getAvatar()
    {
        $file = public_path($this->avatar);
        if (!is_null($this->avatar) && !empty($this->avatar) && file_exists($file)) {
            return asset($this->avatar);
        }
        return $this->getDefaultImage();
    }

    public function getPhoto()
    {
        $file = public_path($this->photo);
        if (!is_null($this->photo) && !empty($this->photo) && file_exists($file)) {
            return asset($this->photo);
        }
        return $this->getDefaultImage();
    }

    public function getWebLogo()
    {
        $file = public_path($this->web_logo);
        if (!is_null($this->web_logo) && !empty($this->web_logo) && file_exists($file)) {
            return asset($this->web_logo);
        }
        return $this->getDefaultImage();
    }

    public function getWebIcon()
    {
        $file = public_path($this->web_ico);
        if (!is_null($this->web_ico) && !empty($this->web_ico) && file_exists($file)) {
            return asset($this->web_ico);
        }
        return $this->getDefaultImage();
    }

    public function getWebBanner()
    {
        $file = public_path($this->web_banner);
        if (!is_null($this->web_banner) && !empty($this->web_banner) && file_exists($file)) {
            return asset($this->web_banner);
        }
        return $this->getDefaultImage();
    }

    public function getLogo()
    {
        $file = public_path($this->logo);
        if (!is_null($this->logo) && !empty($this->logo) && file_exists($file)) {
            return asset($this->logo);
        }
        return $this->getDefaultImage();
    }

    public function getBanner()
    {
        $file = public_path($this->banner);
        if (!is_null($this->banner) && !empty($this->banner) && file_exists($file)) {
            return asset($this->banner);
        }
        return $this->getDefaultImage();
    }

    public function getDefaultImage()
    {
        return asset('cms/dist/img/boxed-bg.jpg');
    }

    public function getUrl()
    {
        return $this->url;
    }
}
