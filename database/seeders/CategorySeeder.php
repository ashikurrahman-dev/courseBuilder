<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            'Technology',
            'Web Development',
            'Mobile Apps',
            'Artificial Intelligence',
            'Data Science',
            'Cloud Computing',
            'Cybersecurity',
            'Blockchain',
            'Internet of Things',
            'Machine Learning'
        ];

        foreach ($items as $item){
            DB::table('categories')->insert([
                'name' => $item,
                'slug' => str::slug($item, '-'),
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}
