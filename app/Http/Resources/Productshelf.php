<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Productshelf extends JsonResource
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
            "order_number" => $this->order_number,
            "total_price" => $this->total_price,
            "total_qty" => $this->total_qty,
            "total_vat" => $this->total_vat,
            "chanel" => $this->chanel,
            "status" => $this->status,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
