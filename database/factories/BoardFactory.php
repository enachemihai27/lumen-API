<?php

namespace Database\Factories;

use App\Models\Board;
use Illuminate\Database\Eloquent\Factories\Factory;

class BoardFactory extends Factory
{
    protected $model = Board::class;

    public function definition(): array
    {
    	return [
    	    'name' => $this->faker->sentence,
            'list_users' => $this->faker->paragraph
    	];
    }
}
