<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Category;
use App\Item;
use App\Brand;
use App\Order;
use Carbon\Carbon;
class FrontendController extends Controller
{
    public function index(){
    	$categories=Category::all();
    	$topitems=Item::all()->random(3);
    	$latestitems=Item::latest()->take(3)->get();
    	$discountitems=Item::whereNotNull('discount')->take(3)->get();
    	
    	//$reviewitems=Item::random(3);
    	return view ('frontend.index',compact('categories','topitems','latestitems','discountitems'));
    }
    public function brand($id){

    	$branditems=Item::where('brand_id',$id)->get();
        $brands=Brand::where('id',$id)->get();
    	//dd($branditems);
    	return view ('frontend.brand',compact('branditems','brands'));

    }
    public function promotion(){
       
        $discountitems=Item::whereNotNull('discount')->paginate(6);
        $discountcount=Item::whereNotNull('discount')->count();


        return view ('frontend.promotion',compact('discountitems','discountcount'));

    }
    public function cart(){
        $carts=Item::All();
        return view('frontend.cart',compact('carts'));
    }

    public function detail($id)
    {

        $details=Item::find($id);
        //dd($details);
        //return redirect()->route('frontend.detail');
        return view('frontend.detail',compact('details'));

    }
    public function order(Request $request){
 //$delieveryprice=$auth->township->price;
        $carts=json_decode($request->data);
        
        $note=$request->note;
        $orderdate=Carbon::now();
        $voucherno=uniqid();
        $total=0;
        foreach($carts as $row){
            $unitprice=$row->unitprice;
            $discount=$row->discount;
            if ($discount)
             {
                $price=$discount;
            }else
            {
                $price=$unitprice;
            }
            $total+=$price*$row->qty;
        }
        $status='Order';
        $auth=Auth::user();
        $userid=$auth->id;

        $order=new Order;
        $order->orderdate=$orderdate;
        $order->voucherno=$voucherno;
        $order->total=$total;
        $order->note=$note;
        $order->status=$status;
        $order->user_id=$userid;
        $order->save();

        foreach($carts as $value)
        {
            $itemid=$value->id;
            $qty=$value->qty;
            $order->items()->attach($itemid,['qty'=>$qty]);
        }
        return response()->json([
            'status'=>'Order Successfully created'
        ]);





        
    }
    public function ordersuccess()
    {
        return view('frontend.ordersuccess');
    }

    public function search(Request $request){

        $keyword=$request->item;

        $searchitem=Item::Where('name','like','%'.$keyword.'%')->get();
    return $searchitem;
    }
  




    public function subcategory($id)
    {
        $items=Item::where('subcategory_id',$id)->get();
        return view('frontend.subcategory',compact('items'));

    }


}
