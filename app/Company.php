<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
		use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = "company";

 public function getactivity()
  	{


    	return $this->hasMany('App\Activity');
    }
    public function getselleroffice()
  	{

    	return $this->hasMany('App\SellerOffice');
    }
    public function getproduct()
  	{

    	return $this->hasMany('App\Product','id');
    }
}
