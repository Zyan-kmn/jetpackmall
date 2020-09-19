<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ItemResource;
use App\Subcategory;
use App\Brand;


class ItemResource extends JsonResource
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
        $photos=json_decode($this->photo,true);

        $photo=$baseurl.'/'.$photos[0];

        //return parent::toArray($request);
        return[
        'item_id'=>$this->id,
        'item_name'=>$this->name,
        'item_codeno'=>$this->codeno,

        'item_photo'=>$photo,
        'item_photos'=>$photos,
        'item_price'=>$this->price,
        'item_discount'=>$this->discount,
        'item_description'=>$this->description,
        'item_subcategory_id'=>$this->subcategory_id,
        'subcategory'=>new SubcategoryResource(Subcategory::find($this->subcategory_id)),
        'item_brand_id'=>$this->brand_id,
        'brand'=>new BrandResource(Brand::find($this->brand_id)),


        'item_created_at'=>$this->created_at->format('d-m-y') ,
        'item_updated_at'=>$this->updated_at->format('d-m-y'),];
    }
}
