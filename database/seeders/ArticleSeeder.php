<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $user = User::first();
        if (!$user) {
            $user = User::create([
                'name' => 'Admin Redaksi',
                'email' => 'admin@report.media',
                'password' => bcrypt('password'),
                'role' => 'superadmin',
            ]);
        }

        $categories = Category::all();

        $articles = [
            [
                'title' => 'Masa Depan Teknologi AI di Indonesia: Peluang dan Tantangan',
                'content' => 'Kecerdasan Buatan (AI) telah menjadi topik hangat di berbagai industri di Indonesia. Dari sektor perbankan hingga pertanian, AI mulai diintegrasikan untuk meningkatkan efisiensi. Namun, tantangan utama tetap pada kesiapan infrastruktur dan talenta digital. Para ahli memprediksi bahwa 5 tahun ke depan akan menjadi masa krusial bagi transformasi digital nasional.',
                'image' => 'https://images.unsplash.com/photo-1677442136019-21780ecad995?auto=format&fit=crop&w=1200&q=80',
                'category' => 'Teknologi',
            ],
            [
                'title' => 'Analisis Ekonomi Kuartal I: Stabilitas di Tengah Ketidakpastian Global',
                'content' => 'Meskipun kondisi ekonomi global sedang mengalami gejolak, ekonomi Indonesia menunjukkan ketahanan yang luar biasa pada kuartal pertama tahun ini. Pertumbuhan yang stabil didorong oleh konsumsi domestik yang kuat dan kenaikan ekspor komoditas unggulan. Pemerintah tetap optimis target pertumbuhan tahunan akan tercapai.',
                'image' => 'https://images.unsplash.com/photo-1611974714405-1a8536f9035a?auto=format&fit=crop&w=1200&q=80',
                'category' => 'Ekonomi',
            ],
            [
                'title' => 'Strategi Tim Nasional Menjelang Kualifikasi Piala Dunia',
                'content' => 'Pelatih tim nasional sepak bola Indonesia telah memanggil jajaran pemain terbaiknya untuk memulai pemusatan latihan. Fokus utama kali ini adalah pada koordinasi lini tengah dan ketajaman penyelesaian akhir. Dengan dukungan penuh dari supporter, tim optimis bisa memberikan kejutan di kancah internasional.',
                'image' => 'https://images.unsplash.com/photo-1574629810360-7efbbe195018?auto=format&fit=crop&w=1200&q=80',
                'category' => 'Olahraga',
            ],
            [
                'title' => 'Inovasi Kendaraan Listrik Lokal Mulai Unjuk Gigi',
                'content' => 'Beberapa startup otomotif asal Indonesia mulai memperkenalkan model kendaraan listrik terbaru mereka dalam pameran internasional. Mengusung konsep ramah lingkungan dengan harga yang kompetitif, produk-produk lokal ini diharapkan mampu bersaing dengan merek global yang sudah lebih dulu mapan di pasar.',
                'image' => 'https://images.unsplash.com/photo-1593941707882-a5bba14938c7?auto=format&fit=crop&w=1200&q=80',
                'category' => 'Otomotif',
            ],
        ];

        foreach ($articles as $data) {
            $cat = $categories->where('name', $data['category'])->first();
            if ($cat) {
                Article::updateOrCreate(
                ['slug' => Str::slug($data['title'])],
                [
                    'title' => $data['title'],
                    'content' => $data['content'],
                    'image' => $data['image'],
                    'category_id' => $cat->id,
                    'user_id' => $user->id,
                    'status' => 'published',
                ]
                );
            }
        }
    }
}
