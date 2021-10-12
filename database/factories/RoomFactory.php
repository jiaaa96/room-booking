<?php

namespace Database\Factories;

use App\Models\Room;
use App\Models\User;
use App\Models\RoomCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class RoomFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Room::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word(),
            'capacity' => $this->faker->numberBetween(1, 50),
            'user_id' => User::pluck('id')->random(),
            'room_category_id' => RoomCategory::pluck('id')->random(),
            'enabled' => true
        ];
    }
}
