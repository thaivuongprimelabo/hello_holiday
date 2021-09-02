<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;
use Cms\Models\OrderDetail;
use Cms\Models\City;
use Cms\Models\District;
use Cms\Models\Block;
use Cms\Constants;

class Order extends Model
{
    use HasFactory, AppModel;

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class);
    }

    public function city() {
        return $this->belongsTo(City::class, 'customer_province', 'matp');
    }

    public function district() {
        return $this->belongsTo(District::class, 'customer_district', 'maqh');
    }

    public function block() {
        return $this->belongsTo(Block::class, 'customer_block', 'xaid');
    }

    public function getTotal() {
        return $this->total ? number_format($this->total, 0, '', '.') : '';
    }

    public function getSubtotal() {
        return $this->subtotal ? number_format($this->subtotal, 0, '', '.') : '';
    }

    public function getCustomerAddress() {
        return $this->customer_address . ', ' . $this->block->name . ', ' . $this->district->name . ', ' . $this->city->name;
    }

    public function getOrderStatusText() {
        if($this->status == Constants::ORDER_STATUS_NEW) {
            return '<span class="tag tag-danger text-primary">ĐH mới</span>';
        }

        if($this->status == Constants::ORDER_STATUS_DELIVERY) {
            return '<span class="tag tag-success text-warning">Đang giao</span>';
        }

        if($this->status == Constants::ORDER_STATUS_FINISH) {
            return '<span class="tag tag-success text-success">Đã hoàn thành</span>';
        }

        if($this->status == Constants::ORDER_STATUS_CANCEL) {
            return '<span class="tag tag-success text-danger">Đã huỷ</span>';
        }
    }
}
