<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guraded =[];

    public function categories()
    {
        return $this->hasMany('App\Admin\Category', 'section_id')->where(['parent_id' => 'ROOT', 'status'=>1])->with('subcategories');
    }
}
