<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductsImage extends Model
{
    public function image()
    {
        return $this->belongsTo('App\Admin\Product', 'product_id');
    }
}
