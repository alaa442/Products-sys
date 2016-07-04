<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
		use SoftDeletes;

    protected $dates = ['deleted_at'];
    public $table="activity";

     public function getcompany()
    {   
        return $this->belongsTo('App\Company','company_id');
    }
}
