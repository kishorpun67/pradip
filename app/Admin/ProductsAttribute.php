<?php

namespace App\Admin;

use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Admin\Product', 'product_id');
    }
}
