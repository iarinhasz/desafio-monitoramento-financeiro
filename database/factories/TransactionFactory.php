<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    public function definition(): array
    {
        return [
            'tipo' => $this->faker->randomElement(['Entrada', 'Saída']),
            'valor' => $this->faker->randomFloat(2, 10, 1000),
            'categoria_id' => Category::inRandomOrder()->first()->id,
            'usuario_id' => User::inRandomOrder()->first()->id,
        ];
    }

}
