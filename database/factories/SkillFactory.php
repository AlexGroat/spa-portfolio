<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Skill;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Skill>
 */
class SkillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // return array of background colors from the customization.json file
        $color = $this->faker->randomElement(Skill::getAvailableBgColors());
        return [
            'name' => $this->faker->unique()->name(),
            'color' => $color,
        ];
    }
}
