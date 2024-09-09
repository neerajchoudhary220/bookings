<?php

namespace App\Http\Requests;

use App\Rules\BookingAvailability;
use Illuminate\Foundation\Http\FormRequest;

class BookingRequest extends FormRequest
{
    /** 
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // dd($this->booking->id);
        return [
            'name' => 'required|string',
            'email' => 'required|email',
            'booking_type' => 'required|in:full_day,half_day',
            'booking_slot' => 'required_if:booking_type,half_day|in:morning,evening',
            'booking_date' => [
                'required',
                'date',
                new BookingAvailability($this->booking_type, $this->booking_slot, $this->booking_date, $this->booking->id??null),
            ],
            'booking_time' => 'required|date_format:H:i',
        ];
    }

    public function messages()
    {
        return [
            'booking_slot.required_if' => 'Booking slot is required for half-day bookings.',
            'booking_slot.in' => 'Invalid booking slot. Choose either morning or evening.',
        ];
    }
}
