<?php

namespace Database\Factories;

use App\Models\Entry;
use BaconQrCode\Encoder\QrCode;
use Illuminate\Database\Eloquent\Factories\Factory;

class EntryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Entry::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'lane' => $this->faker->numberBetween(1, 3),
            'date' => $this->faker->date(),
            'couple_id' => 1,
            'user_id' => 1,
            'places' => $this->faker->numberBetween(1, 3),
        ];
    }
}
