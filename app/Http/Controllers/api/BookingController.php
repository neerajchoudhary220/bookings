<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Resources\BookingDetailsResource;
use App\Http\Resources\BookingListResource;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    public function  list()  {
        $bookings = Booking::orderBy('id','desc')->paginate(10);
        return BookingListResource::collection($bookings);

    }

    public function store(BookingRequest $request){
        try {
            DB::beginTransaction();
            $input = $request->only('name','email','booking_type','booking_slot','booking_date','booking_time');
            $booking = Booking::create($input);
            DB::commit();
            return response()->json(['message' => 'Booking created successfully.', 'data' => $booking]);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json(['error' => 'Failed to store booking.'], 500);
        }
    }


    public function delete(Booking $booking) {
        try {
            DB::beginTransaction();
            $booking->delete();
            DB::commit();
            return response()->json(['message' => 'Booking deleted successfully.']);
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return response()->json(['error' => 'Failed to delete booking.'], 500);
        }
        
    }

    public function update(BookingRequest $request, Booking $booking){
        try {
         
            DB::beginTransaction();
            $input = $request->only('name','email','booking_type','booking_slot','booking_date','booking_time');
            $booking->update($input);
            DB::commit();
            return response()->json(['message' => 'Booking updated successfully.', 'data' => $booking]);
        } catch (\Exception $e) {
            DB::rollBack();
            // dd($e);
            return response()->json(['error' => 'Failed to update booking.'], 500);
        }
    }

    public function details(Booking $booking){
        return new BookingListResource($booking);
    }
}
