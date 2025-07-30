<?php

namespace Database\Seeders;

use App\Models\Content;
use App\Models\Module;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = Module::all();

        foreach ($modules as $module) {
            for ($i = 1; $i <= 3; $i++) {
                Content::create([
                    'module_id' => $module->id,
                    'text' => "Content $i for module {$module->title}",
                    'image' => 'https://via.placeholder.com/640x480.png?text=Image+'. $i,
                    'video' => 'https://www.youtube.com/watch?v=aAQMClhJubM',
                    'link' => 'https://example.com/resource-'.$i,
                ]);
            }
        }
    }
}
