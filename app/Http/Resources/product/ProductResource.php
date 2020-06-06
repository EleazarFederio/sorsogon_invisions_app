<?php

namespace App\Http\Resources\product;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'details' => $this->details,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'category' => $this->category,
            'customer_id' => $this->customer_id,
            'picture' => $this->picture
        ];
    }
}
