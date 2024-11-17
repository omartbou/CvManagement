<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = [
            ['name' => 'Oujda'],
            ['name' => 'Casablanca'],
            ['name' => 'Rabat'],
            ['name' => 'Marrakech'],
            ['name' => 'Fes'],
            ['name' => 'Tangier'],
            ['name' => 'Agadir'],
            ['name' => 'Meknes'],
            ['name' => 'Tetouan'],
            ['name' => 'Kenitra'],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }


}
