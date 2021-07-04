<?php

namespace App\Http\Resources\Rental;

use Illuminate\Http\Resources\Json\JsonResource;

class Rental extends JsonResource
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
            'movie_title' => $this->movie_title,
            'datetime' => $this->datetime,
            'user_id' => $this->user_id,
      
            
        ];
    }
}
