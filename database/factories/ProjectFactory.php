<?php

namespace Database\Factories;

use App\Models\Model;
use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(30),
            'description' => $this->faker->realText(),
            'creator_id' => 1,
            'price' => $this->faker->randomFloat(0, 1000, 100000),
            'views' => $this->faker->numberBetween(0, 1000),
            'city_id' => $this->faker->numberBetween(1, 80)

        ];
    }
}
