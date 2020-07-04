<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $date = Carbon::make($this->created_at);
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'count' => $this->count,
            'created_at' => $date->toDateTimeString(),
            'status' => $this->status,
        ];
    }
}
