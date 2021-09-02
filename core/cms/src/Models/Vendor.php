<?php

namespace Cms\Models;

use Cms\Models\Product;
use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory, AppModel;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
