<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CategoryResource;
use App\Category;

class SubcategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        $baseurl=URL('/');
        //return parent::toArray($request);
        return[
        'subcategory_id'=>$this->id,
        'subcategory_name'=>$this->name,
        'subcategory_category_id'=>$this->category_id,
        'category'=>new CategoryResource(Category::find($this->category_id)),


        'subcategory_created_at'=>$this->created_at->format('d-m-y') ,
        'subcategory_updated_at'=>$this->updated_at->format('d-m-y'),


        ];
    }
}





