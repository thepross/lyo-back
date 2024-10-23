<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nombres" => fake()->name(), 
            "apellidos" => fake()->lastName(), 
            "direccion" => fake()->address(), 
            "telefono" => random_int(1000000, 9999999) . "", 
            "tipo" => random_int(0, 3)
        ];
    }
}
