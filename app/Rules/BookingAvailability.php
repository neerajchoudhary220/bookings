<?php

namespace App\Rules;

use App\Models\Booking;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BookingAvailability implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */

     protected $booking_type;
     protected $booking_slot;
     protected $booking_date;
     protected $booking_id;
     public function __construct($booking_type, $booking_slot, $booking_date, $booking_id=null)
     {
         $this->booking_type = $booking_type;
         $this->booking_slot = $booking_slot;
         $this->booking_date = $booking_date;
         $this->booking_id = $booking_id;
     }


    public function message()
    {
        // Customize the error message based on the conflict
        return 'This booking is not allowed. Either full day or the same slot has already been booked for this date.';
    }

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $existingBooking = Booking::where('booking_date', $this->booking_date)
        ->when($this->booking_id, function ($query) {
            return $query->where('id', '<>', $this->booking_id);
        })
        ->latest()->first();

     
        if ($existingBooking) {
            if ($existingBooking->booking_type == 'full_day') {
                 $fail('Full day already booked');

            }

            if ($this->booking_type == 'full_day') {
                $fail('Can not book full day if half day is already booked');

            }

            if ($existingBooking->booking_slot == $this->booking_slot) {
                $fail('This slot is already booked');

            }
        }

    }
}
