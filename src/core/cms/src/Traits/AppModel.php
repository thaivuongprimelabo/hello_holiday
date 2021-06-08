<?php
namespace Cms\Traits;

use Illuminate\Support\Carbon;

trait AppModel {

    public function getCreatedAt() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y H:i:s');
    }

    public function getStatusText() {

        if($this->status == 0) {
            return '<span class="tag tag-danger text-danger">Tạm dừng</span>';
        }

        if($this->status == 1) {
            return '<span class="tag tag-success text-success">Đang hoạt động</span>';
        }

        if($this->status == 2) {
            return '<span class="tag tag-success text-danger">Đã xoá</span>';
        }
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

    public function getDefaultImage() {
        return asset('cms/dist/img/boxed-bg.jpg');
    }
}