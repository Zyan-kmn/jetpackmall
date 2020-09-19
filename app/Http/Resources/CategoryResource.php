<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $baseurl=URL('/');
        //return parent::toArray($request);
        return[
        'category_id'=>$this->id,
        'category_name'=>$this->name,
        'category_photo'=>$baseurl.'/'.$this->photo,
        'category_created_at'=>$this->created_at->format('d-m-y') ,
        'category_updated_at'=>$this->updated_at->format('d-m-y'),


        ];
    }
}
