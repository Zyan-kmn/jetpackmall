<?php

namespace App\Http\Controllers;
use App\Order;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;


class OrderController extends Controller
{
    public function orderlist(){
    	$orders=Order::all();
    	return view('backend.order.order',compact('orders'));
    }
    public function  ($id){
    	
    }
}
