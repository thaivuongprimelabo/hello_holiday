<?php

namespace Cms\Models;

use Cms\Constants;
use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory, AppModel;

    public function getContactStatusText()
    {

        if ($this->status == Constants::STATUS_UNACTIVE) {
            return '<span class="tag tag-danger text-primary">Thư mới</span>';
        }

        if ($this->status == Constants::STATUS_ACTIVE) {
            return '<span class="tag tag-success text-success">Đã xử lý</span>';
        }
    }
}
