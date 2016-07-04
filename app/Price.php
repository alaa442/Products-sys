<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
		use SoftDeletes;
    protected $dates = ['deleted_at'];

  public function product_price()
    {   
        return $this->belongsTo('App/product');
    }
}
