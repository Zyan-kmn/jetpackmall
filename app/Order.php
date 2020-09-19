<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    protected $fillable=[
    	'orderdate','voucherno','total','note','status'];


        public function users(){
    	return $this->belongsTo('App\User');
    }
        public function items(){
    	return $this->belongsToMany('App\Item','orderdetails','order_id','item_id')
    	->withPivot('qty')
    	->withTimestamps();;
    }


}
