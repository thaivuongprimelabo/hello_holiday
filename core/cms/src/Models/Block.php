<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;
use Cms\Models\Product;

class Block extends Model
{
    use HasFactory, AppModel;

    protected $table = 'devvn_xaphuongthitran';

}
