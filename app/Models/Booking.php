<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    
    //eloquent ORM == object relationship management
    protected $guarded = [];
    
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime'
    ];

    //nak keluarkan id random 
    public function getRouteKeyName()
    {
        return 'uuid';
    }

    //relatonship
    public function booking_status()
    {
        return $this->belongsTo(BookingStatus::class);
    }

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    //accessors
    public function getStartDateFormattedAttribute()
    {
        return $this->start_date ? $this->start_date->format('Y-m-d\TH:i') : null;
    }

    public function getEndDateFormattedAttribute()
    {
        return $this->end_date ? $this->end_date->format('Y-m-d\TH:i') : null;
    }
}
