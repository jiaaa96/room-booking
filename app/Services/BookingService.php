<?php

namespace App\Services;

use App\Models\Room;
use Carbon\Carbon;

class BookingService
{
    public function isRoomTaken($requestData)
    {
        $times = [
            Carbon::parse($requestData['start_date']),
            Carbon::parse($requestData['end_date']),
        ];

        $rooms = Room::query()
            ->where('id', $requestData['room_id'])
            ->whereHas('bookings', function ($query) use ($times) {
                $query->whereBetween('start_date', $times)
                    ->orWhereBetween('end_date', $times)
                    ->orWhere(function ($query) use ($times) {
                        $query->where('start_date', '<', $times[0])
                            ->where('end_date', '>', $times[1]);
                    });
            })
            ->count();

        return ($rooms) ? true : false;
    }

    public function isWithinCapacity($requestData)
    {

        $roomCapacity = Room::query()
            ->where('id', $requestData['room_id'])
            ->where('capacity', '>', (int)$requestData['participant_total'])
            ->count();

        return ($roomCapacity) ? false : true;
    }
}
