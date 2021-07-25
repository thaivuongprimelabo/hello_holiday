<?php

namespace Cms\Models;

use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Models\Product;
use Cms\Models\Category;

class ChildCategory extends Model
{
    use HasFactory, AppModel;

    protected $table = 'categories';

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function parentCategory() {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function getLink()
    {
        $parentCategory = $this->parentCategory;
        return route('product.productsByChildCategory', ['slug' => $parentCategory->name_url, 'child_slug' => $this->name_url]);

    }
}
