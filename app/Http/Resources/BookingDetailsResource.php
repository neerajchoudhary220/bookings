<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'booking_type'=>$this->booking_type,
            'booking_slot'=>$this->booking_slot,
            'booking_date'=>$this->booking_date,
            'booking_time'=>$this->booking_time,

        ];
    }
}
