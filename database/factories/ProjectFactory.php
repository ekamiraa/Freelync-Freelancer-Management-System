<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
use App\Models\User;
use App\Models\Category;

class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Mengambil user secara acak untuk client dan freelancer
        $client = User::role('client')->inRandomOrder()->first();
        $freelancer = User::role('freelancer')->inRandomOrder()->first();

        return [
            'client_id' => $client->id,
            'freelancer_id' => $freelancer->id,
            'title' => $this->faker->sentence(4),
            'desc' => $this->faker->paragraph,
            'budget' => $this->faker->numberBetween(1000, 10000),
            'status' => $this->faker->randomElement(['open', 'in progress', 'waiting approval', 'completed', 'canceled']),
            'deadline' => $this->faker->dateTimeBetween('now', '+1 year'),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Project $project) {
            // Menyematkan 1 hingga 3 kategori ke project
            $categories = Category::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $project->categories()->attach($categories);
        });
    }
}
