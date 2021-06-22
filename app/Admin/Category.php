<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guraded =[];

    public function subcategories() 
    {
        return $this->hasMany('App\Admin\Category', 'parent_id')->where('status',1);
    }
    public function section()
    {
        return $this->belongsTo('App\Admin\Section', 'section_id')->select('id','name');
    }

    public function parentcategory()
    {
        return $this->belongsTo('App\Admin\Category', 'parent_id')->select('id','category_name');
    }
}
