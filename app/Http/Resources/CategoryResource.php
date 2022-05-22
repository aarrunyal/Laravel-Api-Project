<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $resource = [
            "title"=>$this->title,
            "description"=>$this->description,
            "is_active"=>$this->is_active,
            "image_path"=>$this->image_path,
            "id"=>$this->id
        ];
        return $resource;
    }
}
