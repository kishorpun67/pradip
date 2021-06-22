<?php

namespace App\Admin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticableTrait;
use App\Admin\Post;
use Illuminate\Notifications\Notifiable;

class Admin extends \Eloquent implements Authenticatable
{
    use  Notifiable, AuthenticableTrait;

    protected $guard ='admin';

    protected $fillable = [
        'name', 'email', 'number', 'password', 'image','created_at', 'updated_at',
];


    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->hasMany('Admin::class');
    }

    public function posts()
    {
        return $this->hasMany('Post::class', 'admin_id', 'id');
    }

}
