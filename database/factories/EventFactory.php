<?php

namespace Database\Factories;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Event>
 */
class EventFactory extends Factory
{
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'main_image' => $this->faker->imageUrl(640, 480, 'test', true),
            'title' => $this->faker->title(),
            'description' => $this->faker->text(),
            'date' => $this->faker->date(),
            'time' => $this->faker->time(),
            'type' => 'online',
            'link' => 'https://meet.google.com/tbc-vkdv-rnj',
            'address' => $this->faker->address(),
            'duration' => $this->faker->numberBetween(1, 3),
            'lector_id' => 1,
            'category_id' => 1,
            'max_participants' => $this->faker->numberBetween(20, 100),
        ];
    }
}
