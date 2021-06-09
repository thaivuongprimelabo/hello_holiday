<?php
namespace Cms\Traits;

use Illuminate\Support\Carbon;
use Cms\Constants;

trait AppModel {

    public function scopeActive() {
        return $this->where('status', Constants::STATUS_ACTIVE);
    }

    public function getName() {
        return $this->name;
    }

    public function getPrice() {
        return $this->price ? number_format($this->price, 0, '', '.') : 'Liên hệ';
    }

    public function getCost() {
        return $this->price ? number_format($this->cost, 0, '', '.') : 'Liên hệ';
    }

    public function getCreatedAt() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y H:i:s');
    }

    public function getStatusText() {

        if($this->status == Constants::STATUS_UNACTIVE) {
            return '<span class="tag tag-danger text-danger">Tạm dừng</span>';
        }

        if($this->status == Constants::STATUS_ACTIVE) {
            return '<span class="tag tag-success text-success">Đang hoạt động</span>';
        }

        if($this->status == Constants::STATUS_DELETED) {
            return '<span class="tag tag-success text-danger">Đã xoá</span>';
        }
    }

    public function getMediumImage() {
        $file = public_path($this->medium);
        if (!is_null($this->medium) && !empty($this->medium) && file_exists($file)) {
            return asset($this->medium);
        }
        return $this->getDefaultImage();
    }

    public function getSmallImage() {
        $file = public_path($this->small);
        if (!is_null($this->small) && !empty($this->small) && file_exists($file)) {
            return asset($this->small);
        }
        return $this->getDefaultImage();
    }

    public function getLargeImage() {
        $file = public_path($this->image);
        if (!is_null($this->image) && !empty($this->image) && file_exists($file)) {
            return asset($this->image);
        }
        return $this->getDefaultImage();
    }

    public function getAvatar() {
        $file = public_path($this->avatar);
        if (!is_null($this->avatar) && !empty($this->avatar) && file_exists($file)) {
            return asset($this->avatar);
        }
        return $this->getDefaultImage();
    }

    public function getLogo() {
        $file = public_path($this->logo);
        if (!is_null($this->logo) && !empty($this->logo) && file_exists($file)) {
            return asset($this->logo);
        }
        return $this->getDefaultImage();
    }

    public function getBanner() {
        $file = public_path($this->banner);
        if (!is_null($this->banner) && !empty($this->banner) && file_exists($file)) {
            return asset($this->banner);
        }
        return $this->getDefaultImage();
    }

    public function getDefaultImage() {
        return asset('cms/dist/img/boxed-bg.jpg');
    }
}