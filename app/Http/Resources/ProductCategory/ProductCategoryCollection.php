<?php

namespace App\Http\Resources\ProductCategory;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryCollection extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'name'=>$this->name,

        ];
    }
}
