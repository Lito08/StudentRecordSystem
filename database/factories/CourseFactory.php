<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_name'        => $this->faker->unique()->words(3, true),
            'course_description' => $this->faker->sentence,
            'lecturer_id'        => null,   // fill in test as needed
        ];
    }
}
