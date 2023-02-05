<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id"=>$this->id,
            "father"=>$this->father,
            "mother"=>$this->mother,
            "area_id"=>$this->area_id,
            "phone1"=>$this->phone1,
            "phone2"=>$this->phone2,
            "email"=>$this->email
        ];
    }
}
