<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;

class Post extends Model
{
    use HasFactory, AppModel;

    public function getLink()
    {
        return route('post.detail', ['slug' => $this->name_url]);
    }

    public function getDescription()
    {
        return strip_tags($this->description);
    }

}
