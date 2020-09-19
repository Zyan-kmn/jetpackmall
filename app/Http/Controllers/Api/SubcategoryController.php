<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\SubcategoryResource;
use Validator;

use App\Subcategory;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $subcategories=Subcategory::all();
        $result=SubcategoryResource::collection($subcategories);
        $message='Subcategory retrieved successfully.';
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
            'name'=>'required|string|max:255|unique:subcategories',

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
            # code...
        }else
        {
            $name=$request->name;
            $category_id=$request->categoryid;
               //file upload
        
        //Data insert 
        $subcategory= new Subcategory;
        $subcategory->name=$name;
        $subcategory->category_id=$category_id;
        $subcategory->save();

        $status=200;
        $message='Subcategory created Successful';
        $result=new SubcategoryResource($subcategory);

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
         $subcategory=Subcategory::find($id);

        if(is_null($subcategory)){
            #404
            $status=404;
            $message='Subcategory not formed';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message
            ];
            return response()->json($response);           
        }else
        {
            #202
             $message='Subcategory retrieved successfully.';
             $status=200;
             $result= new SubcategoryResource($subcategory);


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

        $name=$request->name;
        $category_id=$request->categoryid;

                  $subcategory=Subcategory::find($id);
 
        $subcategory->name=$name;
        $subcategory->category_id=$category_id;
        $subcategory->save();

            $message='Subcategory updated successfully.';
             $status=200;
             $result= new SubcategoryResource($subcategory);


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
        $subcategory=Subcategory::find($id);
                  if(is_null($subcategory)){
            #404
            $status=404;
            $message='Subcategory not formed';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message
            ];
          return response()->json($response);
      }else{
            $subcategory->delete();

            $message='Subcategory deleted successfully.';
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
