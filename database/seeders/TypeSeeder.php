<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $type = new Type;
        $type->type = 'Frontend';
        $type->color = $faker->hexColor();
        $type->save();

        $type = new Type;
        $type->type = 'Backend';
        $type->color = $faker->hexColor();
        $type->save();

        $type = new Type;
        $type->type = 'Fullstack';
        $type->color = $faker->hexColor();
        $type->save();
    }
}
