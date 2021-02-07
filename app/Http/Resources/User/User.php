<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'rank_id' => $this->rank->id,
            'rank' => $this->rank->rank,
            'email' => $this->email,
            'mobile_no' => $this->mobile_no,
            'description' => $this->description,
            'role' => $this->roles[0]->name,
        ];
    }
}
