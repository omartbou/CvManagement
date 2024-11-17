<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $languages = [
            ['name' => 'Français','code'=>'Fr'],
            ['name' => 'English','code'=>'En'],
            ['name' => 'Arabic','code'=>'Ar'],
            ['name' => 'Spain','code'=>'Sp'],
        ];

        foreach ($languages as $language) {
            Language::create($language);
        }
    }
}
