<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function admin()
    {
        return $this->belognsTo('App\Admin\Admin');
    }

}
