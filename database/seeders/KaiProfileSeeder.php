<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KaiProfile;

class KaiProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Generate random UUID manually using our custom generator
        $profile = new KaiProfile();
        $profile->id = $profile->newUniqueId();
        $profile->nama_perusahaan = 'PT Kereta Api Indonesia (Persero)';
        $profile->slogan = 'Menghubungkan Nusantara dengan Layanan Transportasi Terbaik';
        $profile->visi = 'Menjadi perusahaan transportasi kereta api yang unggul dan terpercaya di Indonesia dengan standar internasional, memberikan layanan yang aman, nyaman, dan ramah lingkungan untuk menghubungkan seluruh Nusantara.';
        $profile->misi = '1. Menyediakan layanan transportasi kereta api yang aman, nyaman, dan tepat waktu
2. Mengembangkan jaringan transportasi yang terintegrasi dan berkelanjutan
3. Meningkatkan kualitas layanan dengan teknologi modern dan sumber daya manusia yang profesional
4. Menjadi mitra terpercaya dalam mendukung pertumbuhan ekonomi dan kesejahteraan masyarakat
5. Melaksanakan tanggung jawab sosial dan lingkungan yang berkelanjutan';
        $profile->alamat = 'Jl. Perintis Kemerdekaan No. 1, Bandung 40117, Jawa Barat, Indonesia';
        $profile->email = 'info@kai.id';
        $profile->telepon = '1500000';
        $profile->save();
    }
}
