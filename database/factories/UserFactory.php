<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        return [
            'cpf' => $this->faker->unique()->numerify('###########'),
            'name' => $this->faker->name(),
            'data_nascimento' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),
        ];
    }
}
