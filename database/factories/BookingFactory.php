<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use App\Models\Booking;
use App\Models\BookingStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Booking::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'applicant' => $this->faker->name(),
            'purpose' => $this->faker->sentence(),
            'notes' => $this->faker->paragraph(),
            'participant_total' => $this->faker->numberBetween(1, 100),
            'start_date' => $this->faker->dateTimeThisMonth(),
            'end_date' => $this->faker->dateTimeThisMonth(),
            'user_id' => User::pluck('id')->random(),
            'room_id' => Room::pluck('id')->random(),
            'booking_status_id' => BookingStatus::pluck('id')->random(),
            //'enabled' => true, takyah pun takpe


        ];
    }
}
