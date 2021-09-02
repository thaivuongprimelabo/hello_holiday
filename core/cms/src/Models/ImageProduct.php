<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;

class ImageProduct extends Model
{
    use HasFactory, AppModel;

    const UPDATED_AT = null;

    const CREATED_AT = null;

    protected $table = 'images_product';

    public function getMainImage() {
        return $this->is_main;
    }
}
