<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;

class ProductTag extends Model
{
    use HasFactory, AppModel;

    protected $table = 'product_tags';

    public function getLink()
    {
        return route('product.productsByTag', ['slug' => $this->name_url]);
    }

}
