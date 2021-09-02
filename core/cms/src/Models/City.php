<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;
use Cms\Models\District;

class City extends Model
{
    use HasFactory, AppModel;

    protected $table = 'devvn_tinhthanhpho';

    public function district() {
        return $this->hasMany(District::class, 'matp', 'matp');
    }

}
