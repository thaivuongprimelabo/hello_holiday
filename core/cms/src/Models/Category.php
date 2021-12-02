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
        if (!is_null($this->parent_id)) {
            $parentCategory = Category::find($this->parent_id);
            return route('product.productsByChildCategory', ['slug' => $parentCategory->name_url, 'child_slug' => $this->name_url]);
        }
        return route('product.productsByCategory', ['slug' => $this->name_url]);
    }

    public function getProducts()
    {
        $products = Product::query()->active()->whereRaw('category_id IN (SELECT id FROM categories WHERE parent_id = ' . $this->id . ')')->orderBy('created_at', 'desc')->limit(5)->get();
        return $products;
    }
}
