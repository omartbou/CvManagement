<?php

namespace Database\Seeders;

use App\Models\Job;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobs = [
            ['name' => 'Dev FullSTACK'],
            ['name' => 'Tester'],
            ['name' => 'Wordpress Developer'],
            ['name' => 'Ui/Ux Developer'],
        ];

        foreach ($jobs as $job) {
            Job::create($job);
        }
    }
}
