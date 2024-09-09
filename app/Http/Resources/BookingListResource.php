<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class BookingListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $time = Carbon::createFromFormat('H:i:s', $this->booking_time);

        return [
          
            'id'=>$this->id,
            'name'=>$this->name,
            'email'=>$this->email,
            'booking_type'=>$this->booking_type,
            'booking_slot'=>$this->booking_slot,
            'booking_date'=>$this->booking_date,
            'booking_time'=>$time->format('h:i A')
            
            
        ];
    }
}
