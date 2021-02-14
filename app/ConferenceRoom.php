<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConferenceRoom extends Model
{
    protected $fillable=[
        "room_id",
        "name",
        "booking_email",
        "sitting",
        "current_status"
    ];
}
