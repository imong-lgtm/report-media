<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceSeeder extends Seeder
{
    public function run()
    {
        DB::table('services')->insert([
            [
                'title' => 'High-Speed Internet',
                'description' => 'Reliable fiber-optic internet solutions for home and business with speeds up to 1Gbps.',
                'image' => 'https://images.unsplash.com/photo-1544197150-b99a580bbcbf?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'VoIP Solutions',
                'description' => 'Crystal clear voice communication over IP networks for cost-effective global calling.',
                'image' => 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Cloud Hosting',
                'description' => 'Secure and scalable cloud infrastructure to host your applications and data.',
                'image' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Network Security',
                'description' => 'Advanced firewall and intrusion detection systems to protect your critical infrastructure.',
                'image' => 'https://images.unsplash.com/photo-1563986768609-322da13575f3?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => '5G Connectivity',
                'description' => 'Next-generation mobile network technology delivering ultra-low latency and massive capacity.',
                'image' => 'https://images.unsplash.com/photo-1614064641938-3bcee52636c4?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Data Center Services',
                'description' => 'State-of-the-art data centers providing colocation and managed services.',
                'image' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=800&q=80',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
