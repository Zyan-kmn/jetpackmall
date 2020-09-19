<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\ItemResource;
use Validator;
use App\Item;


class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items=Item::all();
        $result=ItemResource::collection($items);
        $message='Items retrieved successfully.';
        $status=200;

        $response=[
            'status'=>$status,
            'success'=>true,
            'message'=>$message,
            'data'=>$result
        ];
        return response()->json($response);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

$validator=Validator::make($request->all(),[
            'name'=>'required|string|max:255|unique:items',

        ]);
        if ($validator->fails())
         {
            $status=400;
            $message='Validation Error.';
            $response=[
                'response'=> $status,
                'success'=>false,
                'message'=>$message,
                'data'=>$validator->errors(),
            ];
            return response()->json($response);
            
        }else{
        $codeno = "JPM-".rand(11111,99999);
        $name=$request->name;
        $photo=$request->photo;
        //$codeno=$codeno->codeno;

        
        $price=$request->price;
        $discount=$request->discount;
        $description=$request->description;
        $subcategoryid=$request->subcategoryid;
        $brandid=$request->brandid;
        $file=array();

        $photos=$request->photo;
        foreach ($photos as $value) {
        $imageName=time().'.'.$value->extension();
        $value->move(public_path('images/item'),$imageName);
        $filepath='images/item/'.$imageName;
        array_push($file, $filepath);
         }

         $filepath=json_encode($file);

               //file upload
        

        //Data insert 
        $item= new Item;
        $item->name=$name;
        $item->photo=$filepath;
        $item->codeno=$codeno;
        $item->price=$price;
        $item->discount=$discount;
        $item->description=$description;
        $item->subcategory_id=$subcategoryid;
        $item->brand_id=$brandid;

        $item->save();

        $status=200;
        $message='Item created Successful';
        $result=new ItemResource($item);

        $response=[
            'success'=>true,
            'status'=>$status,
            'message'=>$message,
            'data'=>$result,
        ];
        return response()->json($response);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item=Item::find($id);

        if(is_null($item)){
            #404
            $status=404;
            $message='Item not formed';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message
            ];
            return response()->json($response);           
        }else
        {
            #202
             $message='Items retrieved successfully.';
             $status=200;
             $result= new ItemResource($item);


        $response=[
            'status'=>$status,
            'success'=>true,
            'message'=>$message,
            'data'=>$result
        ];
        return response()->json($response);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
                $codeno = "JPM-".rand(11111,99999);
          $item=Item::find($id);
        $name=$request->name;
        $newphoto=$request->photo;
        //$codeno=$request->codeno;
        $oldphoto=$item->photo;
        $price=$request->price;
        $discount=$request->discount;
        $description=$request->description;
        $subcategoryid=$request->subcategoryid;
        $brandid=$request->brandid;

        if($request->hasFile('photo'))
        {
            $imageName=time().'.'.$newphoto->extension();
            $newphoto->move(public_path('images/item'),$imageName);
            $filepath='images/item/'.$imageName;
            if (\File::exists(public_path($oldphoto))) 
            {
                (\File::delete(public_path($oldphoto)));
            }
        }
        else
        {
            $filepath=$oldphoto;
        }

        $item->name=$name;
        $item->photo=$filepath;
        $item->codeno = $codeno;
        $item->price=$price;
        $item->discount=$discount;
        $item->description=$description;
        $item->subcategory_id=$subcategoryid;
        $item->brand_id=$brandid;

        $item->save();

            $message='Item updated successfully.';
             $status=200;
             $result= new ItemResource($item);


        $response=[
            'status'=>$status,
            'success'=>true,
            'message'=>$message,
            'data'=>$result
        ];
        return response()->json($response);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
                  $item=Item::find($id);
                  if(is_null($item)){
            #404
            $status=404;
            $message='Item not formed';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message
            ];
        
            return response()->json($response);  
            }
            else
            {
  
                   $oldphoto=$item->photo;
          if (\File::exists(public_path($oldphoto))) 
            {
                (\File::delete(public_path($oldphoto)));
            }
           $item->delete();

            $message='Item deleted successfully.';
             $status=200;

         

        $response=[
            'status'=>$status,
            'success'=>true,
            'message'=>$message,
          
        ];
    
        return response()->json($response);
        }
    }
}
