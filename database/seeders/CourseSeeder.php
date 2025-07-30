<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            'Laravel Basics',
            'Vue.js Crash Course',
            'React Fundamentals',
            'PHP for Beginners',
            'JavaScript Mastery',
            'Tailwind CSS Deep Dive',
            'Database Design 101',
            'Full-Stack Web Dev',
            'REST API with Laravel',
            'Livewire Essentials'
        ];

        foreach ($courses as $title){
            Course::create([
                'category_id' => rand(1, 10),
                'title' => $title,
                'slug' => str::slug($title, '-'),
                'batch' => rand(1, 5),
                'price' => rand(5000, 10000),
                'description' => "This is course description for $title",
                'image' => null
            ]);
        }
    }
}
