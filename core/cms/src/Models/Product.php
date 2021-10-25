<?php

namespace Cms\Models;

use Cms\Models\Category;
use Cms\Models\ChildCategory;
use Cms\Models\ImageProduct;
use Cms\Models\Vendor;
use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, AppModel;

    public function imagesProduct()
    {
        return $this->hasMany(ImageProduct::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }

    public function getLink()
    {
        return route('product.detail', ['slug' => $this->name_url]);
    }

    public function getTags()
    {
        $tags = Tag::query()->active()->whereIn('id', explode(',', $this->tags))->get();
        return $tags;
    }
}
