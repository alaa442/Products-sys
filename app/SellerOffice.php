<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class SellerOffice extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    public $table = "selleroffice";
   protected $fillable = array(
        'selleroffice_id','product_id'
    );
 
    public function getcompany()
    {   
        return $this->belongsTo('App\Company','company_id');
    }
    public function getsellerofficeproduct()
    {
        return $this->belongsToMany('App\Product','product_selleroffice','selleroffice_id','product_id');
    }
}
