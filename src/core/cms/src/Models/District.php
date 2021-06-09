<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;
use Cms\Models\Block;

class District extends Model
{
    use HasFactory, AppModel;

    protected $table = 'devvn_quanhuyen';

    public function block() {
        return $this->hasMany(Block::class, 'maqh', 'maqh');
    }

}
