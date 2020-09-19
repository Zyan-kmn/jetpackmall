<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          $brands=Brand::all();//database ka category all koe swal htcok chin
       // dd($categories);
        return view('backend.brand.list',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         return view('backend.brand.new');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator=$request->validate([
            'name'=>['required','string','max:255','unique:categories'],
            'logo'=>'required|mimes:jpeg,bmp,png,jpg'
        ]);
                if ($validator) {
        $name=$request->name;
        $logo=$request->logo;

          //file upload
        $logoName=time().'.'.$logo->extension();
        $logo->move(public_path('images/brand'),$logoName);
        $filepath='images/brand/'.$logoName;

        //Data insert 
        $brand= new Brand;
        $brand->name=$name;
        $brand->logo=$filepath;
        $brand->save();
        return redirect()->route('backside.brand.index')->with("successMsg",'New Brand is ADDED in your data');
        }
        else
        {
            return redirect::back()->withErrors($validator);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $brand = Brand::find($id);
        return view('backend.brand.edit',compact('brand'));
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
         $validator = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'photo' => 'sometimes|mimes:jpeg,bmp,png,jpg'

        ]);

        if($validator)
        {
            $name = $request->name;
            $newphoto = $request->photo;
            $oldphoto = $request->oldPhoto;

            // File Upoload
            if ($request->hasFile('photo')) {
                $imageName = time().'.'.$newphoto->extension();  
           
                $newphoto->move(public_path('images/brand'), $imageName);

                $filepath = 'images/brand/'.$imageName;

                if(\File::exists(public_path($oldphoto))){
                    \File::delete(public_path($oldphoto));
                }

            }else{
                
                $filepath = $oldphoto;

            }

            // Data insert
            $brand = Brand::find($id);
            $brand->name = $name;
            $brand->logo = $filepath;

            $brand->save();

            // Return 
            return redirect()->route('backside.brand.index')->with("successMsg", "New Brand is UPDATED in your data");
        }
        else
        {
            return Redirect::back()->withErrors($validator);
        }
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $brand=Brand::find($id);
         $brand->delete();
        return redirect()->route('backside.brand.index')->with('successMsg','Existing Brand is DELETED in your data');
    }
}
