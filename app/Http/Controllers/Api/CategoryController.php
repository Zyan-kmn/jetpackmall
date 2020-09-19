<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Category;
use Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories=Category::all();
        $result=CategoryResource::collection($categories);
        $message='Category retrieved successfully.';
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
            'name'=>'required|string|max:255|unique:categories',
            'photo'=>'required|mimes:jpg,png,jpeg,bmp'
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
        }else{
            $name=$request->name;
            $photo=$request->photo;
               //file upload
        $imageName=time().'.'.$photo->extension();
        $photo->move(public_path('images/category'),$imageName);
        $filepath='images/category/'.$imageName;

        //Data insert 
        $category= new Category;
        $category->name=$name;
        $category->photo=$filepath;
        $category->save();

        $status=200;
        $message='Category created Successful';
        $result=new CategoryResource($category);

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
        $category=Category::find($id);

        if(is_null($category)){
            #404
            $status=404;
            $message='Category not formed';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message
            ];
            return response()->json($response);           
        }else
        {
            #202
             $message='Category retrieved successfully.';
             $status=200;
             $result= new CategoryResource($category);


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
    {        $category=Category::find($id);

        $name=$request->name;
        $newphoto=$request->photo;
        $oldphoto=$category->photo;

        if($request->hasFile('photo'))
        {
            $imageName=time().'.'.$newphoto->extension();
            $newphoto->move(public_path('images/category'),$imageName);
            $filepath='images/category/'.$imageName;
            if (\File::exists(public_path($oldphoto))) 
            {
                (\File::delete(public_path($oldphoto)));
            }
        }
        else
        {
            $filepath=$oldphoto;
        }
        
        $category->name=$name;
        $category->photo=$filepath;
        $category->save();

            $message='Category updated successfully.';
             $status=200;
             $result= new CategoryResource($category);


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

          $category=Category::find($id);
                  if(is_null($category)){
            #404
            $status=404;
            $message='Category not formed';
            $response=[
                'status'=>$status,
                'success'=>false,
                'message'=>$message
            ];
        
            return response()->json($response);  
            }
            else
            {
  
                   $oldphoto=$category->photo;
          if (\File::exists(public_path($oldphoto))) 
            {
                (\File::delete(public_path($oldphoto)));
            }
           $category->delete();

            $message='Category deleted successfully.';
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
