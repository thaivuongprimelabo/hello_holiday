<?php

namespace Cms\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cms\Traits\AppModel;

class Config extends Model
{
    use HasFactory, AppModel;

    protected $table = 'config';

    public function getMaxUploadListAttribute()
    {
        $result = json_decode($this->max_upload, true);
        return $result;
    }
}
