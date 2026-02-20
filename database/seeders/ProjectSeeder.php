<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('projects')->insert([
            [
                'title' => 'Smart City Infrastructure',
                'description' => 'Deployed a city-wide IoT network to monitor traffic, energy usage, and public safety.',
                'client' => 'City of Futureville',
                'completion_date' => '2025-11-15',
                'image' => 'https://images.unsplash.com/photo-1480714378408-67cf0d13bc1b?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Global Fiber Expansion',
                'description' => 'Laid over 5,000 km of fiber optic cables connecting three major continents.',
                'client' => 'InterConnect Global',
                'completion_date' => '2025-08-22',
                'image' => 'https://images.unsplash.com/photo-1544197150-b99a580bbcbf?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Remote Healthcare Network',
                'description' => 'Established a secure telemedicine network for rural hospitals and clinics.',
                'client' => 'HealthFirst Alliance',
                'completion_date' => '2025-05-10',
                'image' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '5G Stadium Coverage',
                'description' => 'Implemented high-density 5G coverage for a 80,000 seat sports stadium.',
                'client' => 'National Sports Arena',
                'completion_date' => '2026-01-30',
                'image' => 'https://images.unsplash.com/photo-1522770179533-24471fcdba45?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
