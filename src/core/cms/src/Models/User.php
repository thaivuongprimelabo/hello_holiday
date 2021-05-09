<?php

namespace Cms\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Cms\Traits\AppModel;

class User extends Authenticatable
{
    use HasFactory, Notifiable, AppModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getAvatar() {
        return !is_null($this->avatar) ? asset($this->avatar) : $this->getDefaultAvatar();
    }

    public function getStatusText() {

        if($this->status == 0) {
            return '<span class="tag tag-danger text-danger">Tạm dừng</span>';
        }

        if($this->status == 1) {
            return '<span class="tag tag-success text-success">Đã xác nhận</span>';
        }
    }

    public function getDefaultAvatar() {
        return asset('cms/dist/img/user2-160x160.jpg');
    }
}