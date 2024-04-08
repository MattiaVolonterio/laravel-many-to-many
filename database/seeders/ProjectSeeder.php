<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $types_id = Type::all()->pluck('id');

        $project = new Project;
        $project->type_id = $faker->randomElement($types_id);
        $project->title = 'vue-boolzapp';
        $project->author = 'Mattia Volonterio';
        $project->description = 'Una webapp simile a whatsapp web creata con vue';
        $project->project_link = 'https://github.com/MattiaVolonterio/vue-boolzapp';
        $project->save();
    }
}
