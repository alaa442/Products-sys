<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = "product";
    protected $fillable = array(
        'selleroffice_id','product_id'
    );
    public function getcompanyproduct()
    {   
        return $this->belongsTo('App\Company','company_id');
    }
    public function price()
    {

        return $this->hasMany('App\Price','id');
    }
     public function getproductselleroffice()
    {
        return $this->belongsToMany('App\SellerOffice','product_selleroffice','product_id','selleroffice_id');
    }
}
