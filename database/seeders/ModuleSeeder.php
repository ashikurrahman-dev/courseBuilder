<?php

namespace Database\Seeders;

use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $moduleTitles = [
            'Introduction to the Course',
            'Setting Up the Environment',
            'Understanding MVC Architecture',
            'Routing and Controllers',
            'Working with Models and Migrations',
            'Blade Templating and Views',
            'Authentication and Authorization',
            'CRUD Operations',
            'API Development',
            'Deploying Your Project',
        ];

        foreach($moduleTitles as $title){
            Module::create([
                'course_id' => rand(1, 10),
                'title' => $title,
            ]);
        }
    }
}
