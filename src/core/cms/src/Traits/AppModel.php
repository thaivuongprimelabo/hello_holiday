<?php
namespace Cms\Traits;

use Illuminate\Support\Carbon;

trait AppModel {

    public function getCreatedAt() {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d-m-Y H:i:s');
    }
}