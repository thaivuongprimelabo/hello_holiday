<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;
use Cms\Models\Product;

class Vendor extends Model
{
    use HasFactory, AppModel;

    public function products() {
        return $this->hasMany(Product::class);
    }
}
