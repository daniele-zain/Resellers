<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return[
        'id'=>$this->id,
        'product'=>$this->product_id,
        'customer'=>$this->customer_id,
        'quantity'=>$this->quantity,
        'total_price'=>$this->total_price,
        'created_at'=>$this->created_at->format('d/m/y'),
        'updated_at'=>$this->updated_at->format('d/m/y')
        ];
    }
}
