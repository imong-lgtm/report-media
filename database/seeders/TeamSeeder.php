<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('teams')->insert([
            [
                'name' => 'Sarah Connor',
                'role' => 'Chief Executive Officer',
                'photo' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Sarah has over 20 years of experience in telecommunications and leadership.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'John Reese',
                'role' => 'Chief Technology Officer',
                'photo' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?auto=format&fit=crop&w=800&q=80',
                'bio' => 'John is a visionary tech leader with a passion for innovation and network security.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Emily Carter',
                'role' => 'Head of Operations',
                'photo' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Emily ensures smooth day-to-day operations and oversees major project deployments.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Michael Chang',
                'role' => 'Lead Network Architect',
                'photo' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?auto=format&fit=crop&w=800&q=80',
                'bio' => 'Michael designs robust and scalable network solutions for our enterprise clients.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
