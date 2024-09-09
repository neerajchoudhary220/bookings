<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Booking extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'booking_type',
        'booking_slot',
        'booking_date',
        'booking_time',
    ];




}
