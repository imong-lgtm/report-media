<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::updateOrCreate(
        ['email' => 'admin@telecom.test'],
        [
            'name' => 'Administrator',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        ]
        );

        $this->call([
            ServiceSeeder::class ,
            ProjectSeeder::class ,
            TeamSeeder::class ,
        ]);
    }
}
