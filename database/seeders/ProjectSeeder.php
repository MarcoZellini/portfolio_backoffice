<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 30; $i++) {
            $project = new Project();
            $project->type_id = rand(1, 5);
            $project->title = $faker->realText(80);
            $project->slug = Str::slug($project->title, '-');
            $project->description = $faker->realText(300);
            $project->cover_image = 'https://unsplash.it/600/400?image=' . rand(1, 1000);
            $project->github_link = $faker->url();
            $project->website_link = $faker->url();
            $project->save();
        }
    }
}
