<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;
use Cms\Models\ImageProduct;
use Cms\Models\Category;
use Cms\Models\Vendor;

class Product extends Model
{
    use HasFactory, AppModel;

    public function imagesProduct() {
        return $this->hasMany(ImageProduct::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }
    
    public function vendor() {
        return $this->belongsTo(Vendor::class);
    }
}
