<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;
use App\Models\AboutPage;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@sbp.com'],
            [
                'name' => 'SBP Admin',
                'password' => bcrypt('password123'),
            ]
        );

        // Site Settings — konten Hero & Home
        $settings = [
            'hero_title'        => 'Pioneering Sustainable Mining for a Better Future',
            'hero_subtitle'     => 'Setting the global standard in operational excellence, environmental stewardship, and social responsibility across our diverse mining activities.',
            'hero_cta_primary'  => 'Explore Our Operations',
            'hero_cta_secondary'=> 'Sustainability Report',
            'about_home_title'  => 'A Leader in Mining Excellence',
            'about_home_content'=> 'PT. Sumber Bumi Putera stands at the forefront of the Indonesian mining industry. Founded on the principles of integrity and innovation, we have spent decades refining our extraction processes to minimize environmental footprint while maximizing resource efficiency.',
            'stat_years'        => '32',
            'stat_production'   => '12M+',
            'stat_manhours'     => '5M+',
            'stat_sites'        => '14',
            'contact_address'   => 'Jl. Letjen S. Parman No.1, Kota Jakarta Barat, Daerah Khusus Ibukota Jakarta',
            'contact_phone'     => '+62 411 000 0000',
            'contact_email'     => 'info@sbp.co.id',
            'contact_hours'     => 'Senin - Jumat, 08.00 - 17.00 WIB',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::set($key, $value);
        }

        // About Pages
        $aboutPages = [
            [
                'section' => 'company',
                'title'   => 'Tentang Perusahaan',
                'content' => 'PT. Sumber Bumi Putera (SBP) adalah perusahaan pertambangan nikel terkemuka di Indonesia. Berdiri sejak 1988, kami telah membangun reputasi kami atas dasar integritas, inovasi, dan komitmen terhadap keberlanjutan lingkungan.',
            ],
            [
                'section' => 'vision_mission',
                'title'   => 'Visi & Misi',
                'content' => 'Visi: Menjadi perusahaan pertambangan nikel yang paling berkelanjutan dan dipercaya di Asia Tenggara. Misi: Mengoperasikan tambang dengan standar keselamatan tertinggi, meminimalkan dampak lingkungan, dan memberikan nilai terbaik bagi seluruh pemangku kepentingan.',
            ],
            [
                'section' => 'history',
                'title'   => 'Sejarah Singkat',
                'content' => '1988: Perusahaan didirikan dengan konsesi pertambangan pertama di Kalimantan Barat. 2005: Penawaran umum perdana dan ekspansi ke Sulawesi. 2018: Peluncuran program keberlanjutan hijau. Saat ini: Transformasi digital operasional tambang.',
            ],
            [
                'section' => 'assets',
                'title'   => 'Aset Perusahaan',
                'content' => 'SBP mengelola portofolio aset pertambangan yang beragam, termasuk 14 lokasi aktif, armada alat berat modern, fasilitas pemrosesan nikel berkapasitas tinggi, dan infrastruktur pendukung yang terintegrasi.',
            ],
        ];

        foreach ($aboutPages as $page) {
            AboutPage::updateOrCreate(
                ['section' => $page['section']],
                $page
            );
        }
    }
}
