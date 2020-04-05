<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\RegisterUser;
use App\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'active', 'provider', 'provider_id', 'admin'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function sendRegisterNotification($activasion,$url)
    {
        $this->notify(new RegisterUser($activasion,$url));
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function Met_evaluates()
    {
        /**
         * Post::class related 关联模型
         * user_id foreignKey 当前表关联字段
         * id localKey 关联表字段
         */
        return $this->hasMany('App\Models\Met_evaluates', 'user_id', 'id');
    }

    public function Transaction()
    {
        /**
         * Post::class related 关联模型
         * user_id foreignKey 当前表关联字段
         * id localKey 关联表字段
         */
        return $this->hasMany('App\Models\Transaction', 'user_id', 'id');
    }

    public function Message()
    {
        /**
         * Post::class related 关联模型
         * user_id foreignKey 当前表关联字段
         * id localKey 关联表字段
         */
        return $this->hasMany('App\Models\Message', 'user_id', 'id');
    }

    public function Reply()
    {
        /**
         * Post::class related 关联模型
         * user_id foreignKey 当前表关联字段
         * id localKey 关联表字段
         */
        return $this->hasMany('App\Models\Reply', 'user_id', 'id');
    }
}
