<?php

namespace Cms\Models;

use Cms\Models\Product;
use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testing extends Model
{
    use HasFactory, AppModel;

    protected $table = 'testing';
}
