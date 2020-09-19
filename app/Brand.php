<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Brand extends Model
{
        protected $fillable=[
        	'name','logo'
        ];


    public function items(){
    	return $this->hasMany('App\Item');
    }


}
