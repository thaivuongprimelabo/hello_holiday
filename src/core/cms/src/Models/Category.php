<?php

namespace Cms\Models;

use Cms\Models\ChildCategory;
use Cms\Models\Product;
use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory, AppModel;

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function childCategories()
    {
        return $this->hasMany(ChildCategory::class, 'parent_id', 'id');
    }

    public function getLink()
    {
        return route('product.productsByCategory', ['slug' => $this->name_url]);
    }
}
