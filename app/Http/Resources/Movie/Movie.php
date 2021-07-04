<?php

namespace App\Http\Resources\Movie;

use Illuminate\Http\Resources\Json\JsonResource;

class Movie extends JsonResource
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
            'title' => $this->title,
            'release_date' => $this->release_date,
            'genre' =>  $this->genre,
            'producer' =>  $this->producer,
            'synopsis' =>  $this->synopsis,
            'user_id' => $this->user_id,
        ];
    }
}
