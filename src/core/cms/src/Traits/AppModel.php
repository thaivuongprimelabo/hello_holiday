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
    }
}