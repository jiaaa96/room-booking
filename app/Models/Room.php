<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

  //  protected $fillable = ['name', '...'];

    protected $guarded = [];

    public function room_category()
    {
        return $this->belongsTo(RoomCategory::class);
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

}
