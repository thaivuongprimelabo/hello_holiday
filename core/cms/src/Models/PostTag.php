<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;

class PostTag extends Model
{
    use HasFactory, AppModel;

    protected $table = 'post_tags';

    public function getLink()
    {
        return route('post.postsByTag', ['slug' => $this->name_url]);
    }

}
