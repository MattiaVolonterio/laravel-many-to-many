<?php

namespace Database\Seeders;

use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $technologies_data = [
            'HTML',
            'CSS',
            'Bootstrap',
            'Javascript',
            'VueJs',
            'Vite',
            'SCSS',
            'PHP',
            'MySQL',
            'Laravel'
        ];

        foreach ($technologies_data as $data) {
            $technology = new Technology;
            $technology->type = $data;
            $technology->color = $faker->hexColor();
            $technology->save();
        }
    }
}
