<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'nik' => $this->faker->numerify('330#############'),
            'phone' => $this->faker->e164PhoneNumber(),
            'graduating_class' => $this->faker->numberBetween($min = 2018, $max = 2022),
            'graduation_year' => $this->faker->numberBetween($min = 2022, $max = 2025),
            'id_major' => $this->faker->randomElement(['1', '2', '3']),
            'place_of_birth' => $this->faker->state(),
            'date_of_birth' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'address' => $this->faker->streetAddress(),
            'business_field' => $this->faker->catchPhrase(),
            'job' => $this->faker->jobTitle(),
            'corresponding_major' => $this->faker->randomElement(['0', '1']),
            'university' => $this->faker->city(),
            'study_program' => $this->faker->catchPhrase(),
            // 'last_login' => $this->faker->dateTime($max = 'now', $timezone = null),
            'status' => $this->faker->randomElement(['0', '1']),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => 12345,
            'created_at' => now()
        ];
    }
}
