<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KaiAbout;

class KaiAboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $aboutData = [
            [
                'judul' => 'Pembentukan Perusahaan',
                'tahun' => '1945',
                'deskripsi' => 'PT Kereta Api Indonesia (Persero) didirikan pada tanggal 28 September 1945, tepat setelah proklamasi kemerdekaan Indonesia. Perusahaan ini dibentuk untuk mengelola dan mengoperasikan sistem transportasi kereta api di seluruh Indonesia.'
            ],
            [
                'judul' => 'Modernisasi Infrastruktur',
                'tahun' => '1960',
                'deskripsi' => 'Memasuki era modernisasi, KAI mulai memperbarui infrastruktur dan armada kereta api. Rel-rel baru dibangun dan kereta api berteknologi lebih modern diperkenalkan untuk meningkatkan kualitas layanan.'
            ],
            [
                'judul' => 'Era Komersialisasi',
                'tahun' => '1991',
                'deskripsi' => 'KAI mengalami transformasi besar dengan menjadi perusahaan perseroan terbatas (Persero). Perubahan status ini memungkinkan KAI untuk lebih mandiri dalam mengelola operasional dan mengembangkan bisnis transportasi kereta api.'
            ],
            [
                'judul' => 'Pembangunan Jalur Ganda',
                'tahun' => '2000',
                'deskripsi' => 'KAI memulai program pembangunan jalur ganda di beberapa rute utama untuk meningkatkan kapasitas dan keamanan operasional. Program ini menjadi tonggak penting dalam sejarah modern KAI.'
            ],
            [
                'judul' => 'Teknologi Digital',
                'tahun' => '2010',
                'deskripsi' => 'KAI mengadopsi teknologi digital dalam sistem tiket online, informasi real-time, dan manajemen operasional. Sistem tiket elektronik dan aplikasi mobile diperkenalkan untuk kemudahan penumpang.'
            ],
            [
                'judul' => 'Layanan Premium',
                'tahun' => '2020',
                'deskripsi' => 'KAI memperkenalkan layanan kereta api premium seperti Argo Parahyangan dan Kereta Cepat Jakarta-Bandung. Layanan ini menawarkan kenyamanan dan kecepatan tinggi untuk perjalanan jarak jauh.'
            ]
        ];

        foreach ($aboutData as $data) {
            $about = new KaiAbout();
            $about->id = $about->newUniqueId();
            $about->judul = $data['judul'];
            $about->deskripsi = $data['deskripsi'];
            $about->tahun = $data['tahun'];
            $about->save();
            
            // Add small delay to ensure different UUIDs
            usleep(1000); // 1ms delay
        }
    }
}
