<?php

namespace App\Http\Resources\process;

use Illuminate\Http\Resources\Json\JsonResource;

class ProcessResource extends JsonResource
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
            'labels' => $this->process_name,
            'data' => $this->product_id
        ];
    }
}
