<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;

class Tag extends Model
{
    use HasFactory, AppModel;

    protected $table = 'tags';

    public function scopeProductTag() {
        return $this->where('type', 'product');
    }

    public function scopePostTag() {
        return $this->where('type', 'post');
    }

    public function getProductLink()
    {
        return route('product.productsByTag', ['slug' => $this->slug]);
    }

    public function getPostLink()
    {
        return route('post.postsByTag', ['slug' => $this->slug]);
    }

}
