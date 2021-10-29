<?php

namespace Cms\Models;

use Cms\Traits\AppModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActionHistory extends Model
{
    use HasFactory, AppModel;

    protected $table = 'action_histories';

    protected $fillable = ['action', 'url', 'ip_address'];

    public static function createHistory($params)
    {
        if (auth()->user()->id !== 1) {
            $params['ip_address'] = self::getIpAddress();
            $params['url'] = url()->current();
            return self::query()->create($params);
        }
        
    }

    public static function getIpAddress()
    {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } else if (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } else if (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } else if (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } else if (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } else if (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

}
