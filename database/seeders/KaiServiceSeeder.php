<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KaiService;

class KaiServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicesData = [
            [
                'nama_layanan' => 'Kereta Api Eksekutif',
                'deskripsi' => 'Layanan kereta api kelas eksekutif dengan fasilitas premium, kursi yang nyaman, AC, dan layanan makan. Cocok untuk perjalanan bisnis dan perjalanan jarak jauh yang membutuhkan kenyamanan maksimal.',
                'icon' => 'fas fa-crown'
            ],
            [
                'nama_layanan' => 'Kereta Api Bisnis',
                'deskripsi' => 'Layanan kereta api kelas bisnis dengan fasilitas standar yang nyaman, kursi reclining, AC, dan tersedia layanan makanan ringan. Pilihan yang tepat untuk perjalanan dengan budget menengah.',
                'icon' => 'fas fa-briefcase'
            ],
            [
                'nama_layanan' => 'Kereta Api Ekonomi',
                'deskripsi' => 'Layanan kereta api kelas ekonomi dengan harga terjangkau namun tetap nyaman. Dilengkapi dengan AC dan kursi yang ergonomis untuk perjalanan yang menyenangkan.',
                'icon' => 'fas fa-users'
            ],
            [
                'nama_layanan' => 'Kereta Commuter',
                'deskripsi' => 'Layanan kereta commuter untuk perjalanan sehari-hari dengan frekuensi tinggi dan harga terjangkau. Cocok untuk perjalanan urban dan suburban dengan jadwal yang padat.',
                'icon' => 'fas fa-subway'
            ],
            [
                'nama_layanan' => 'Kereta Wisata',
                'deskripsi' => 'Layanan kereta wisata dengan pemandangan indah dan fasilitas khusus untuk wisatawan. Dilengkapi dengan guide dan paket wisata yang menarik untuk menikmati keindahan Indonesia.',
                'icon' => 'fas fa-camera'
            ],
            [
                'nama_layanan' => 'Layanan Kargo',
                'deskripsi' => 'Layanan pengiriman barang dan kargo dengan sistem logistik yang terintegrasi. Aman, cepat, dan terjangkau untuk kebutuhan pengiriman barang dalam skala besar maupun kecil.',
                'icon' => 'fas fa-boxes'
            ],
            [
                'nama_layanan' => 'Kereta Cepat',
                'deskripsi' => 'Layanan kereta api berkecepatan tinggi dengan teknologi terdepan. Menawarkan perjalanan yang cepat, nyaman, dan efisien untuk rute-rute strategis di Indonesia.',
                'icon' => 'fas fa-bolt'
            ],
            [
                'nama_layanan' => 'Kereta Malam',
                'deskripsi' => 'Layanan kereta api malam dengan fasilitas tidur yang nyaman. Dilengkapi dengan kamar tidur, AC, dan fasilitas lengkap untuk perjalanan jarak jauh yang memakan waktu semalaman.',
                'icon' => 'fas fa-moon'
            ]
        ];

        foreach ($servicesData as $data) {
            $service = new KaiService();
            $service->id = $service->newUniqueId();
            $service->nama_layanan = $data['nama_layanan'];
            $service->deskripsi = $data['deskripsi'];
            $service->icon = $data['icon'];
            $service->gambar = $data['gambar'] ?? null;
            $service->save();
            
            // Add small delay to ensure different UUIDs
            usleep(1000); // 1ms delay
        }
    }
}
