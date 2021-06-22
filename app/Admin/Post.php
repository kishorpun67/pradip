<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function admin()
    {
    	return $this->belongsTo('App\Admin\Admin', 'admin_id', 'id');
    }
}
