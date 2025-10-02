<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\KaiNews;
use Carbon\Carbon;

class KaiNewsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newsData = [
            [
                'judul' => 'KAI Luncurkan Layanan Kereta Cepat Jakarta-Bandung',
                'isi' => 'PT Kereta Api Indonesia (Persero) telah resmi meluncurkan layanan kereta cepat Jakarta-Bandung yang menghubungkan ibu kota dengan Bandung dalam waktu tempuh hanya 45 menit. Layanan ini menggunakan teknologi terdepan dengan kecepatan hingga 350 km/jam.

Kereta cepat ini dilengkapi dengan fasilitas modern seperti WiFi gratis, kursi yang nyaman, dan layanan makanan premium. Tiket dapat dipesan melalui aplikasi KAI atau website resmi dengan harga yang kompetitif.

"Ini adalah pencapaian besar bagi transportasi Indonesia," ujar Direktur Utama KAI. "Kami berkomitmen untuk terus meningkatkan kualitas layanan transportasi kereta api di Indonesia."

Layanan ini diharapkan dapat mengurangi kemacetan di jalur Jakarta-Bandung sekaligus memberikan alternatif transportasi yang efisien dan ramah lingkungan.',
                'penulis' => 'Tim Redaksi KAI',
                'tanggal' => Carbon::now()->subDays(2)
            ],
            [
                'judul' => 'KAI Raih Penghargaan Best Railway Company 2024',
                'isi' => 'PT Kereta Api Indonesia (Persero) berhasil meraih penghargaan Best Railway Company 2024 dari International Railway Association atas inovasi dan kualitas layanan yang luar biasa.

Penghargaan ini diberikan setelah penilaian menyeluruh terhadap berbagai aspek seperti keamanan, kenyamanan penumpang, inovasi teknologi, dan kepuasan pelanggan. KAI dinilai telah menunjukkan komitmen tinggi dalam memberikan layanan transportasi kereta api yang berkualitas.

"Penghargaan ini adalah bukti bahwa transformasi digital dan peningkatan kualitas layanan yang kami lakukan telah diakui secara internasional," kata Direktur Operasional KAI.

Dalam tahun 2024, KAI telah berhasil meningkatkan kepuasan penumpang hingga 95% dan mengurangi delay hingga 98%. Pencapaian ini didukung oleh investasi besar-besaran dalam teknologi dan pelatihan SDM.',
                'penulis' => 'Departemen Komunikasi KAI',
                'tanggal' => Carbon::now()->subDays(5)
            ],
            [
                'judul' => 'KAI Perkenalkan Sistem Tiket Digital Terintegrasi',
                'isi' => 'PT Kereta Api Indonesia (Persero) memperkenalkan sistem tiket digital terintegrasi yang memungkinkan penumpang untuk melakukan perjalanan tanpa perlu mencetak tiket fisik.

Sistem baru ini menggunakan QR code yang dapat diakses melalui smartphone. Penumpang hanya perlu menunjukkan QR code di gerbang masuk tanpa perlu antri untuk mengambil tiket fisik.

"Ini adalah langkah besar menuju era digitalisasi transportasi," ungkap Direktur Teknologi Informasi KAI. "Sistem ini tidak hanya memudahkan penumpang, tetapi juga lebih ramah lingkungan."

Fitur-fitur baru dalam sistem tiket digital meliputi:
- Pemesanan tiket real-time
- Notifikasi delay otomatis
- Integrasi dengan aplikasi transportasi lainnya
- Sistem loyalitas dan cashback

Sistem ini telah diujicobakan di beberapa rute utama dan akan diluncurkan secara bertahap di seluruh jaringan KAI dalam 6 bulan ke depan.',
                'penulis' => 'Tim Digital KAI',
                'tanggal' => Carbon::now()->subDays(7)
            ],
            [
                'judul' => 'KAI Buka Jalur Baru Surabaya-Yogyakarta',
                'isi' => 'PT Kereta Api Indonesia (Persero) meresmikan jalur baru yang menghubungkan Surabaya dengan Yogyakarta melalui rute yang lebih efisien dan pemandangan yang menakjubkan.

Jalur baru ini mengurangi waktu tempuh dari 8 jam menjadi 6 jam dengan fasilitas modern dan pemandangan alam yang indah sepanjang perjalanan.

"Jalur ini tidak hanya lebih cepat, tetapi juga menawarkan pengalaman perjalanan yang tak terlupakan," kata Manajer Operasional Regional Jawa Timur.

Kereta yang melayani rute ini dilengkapi dengan jendela besar untuk menikmati pemandangan, WiFi gratis, dan layanan makanan khas daerah yang dilayani oleh kereta tersebut.

Pembukaan jalur ini diharapkan dapat meningkatkan kunjungan wisata ke kedua kota dan memberikan alternatif transportasi yang nyaman untuk masyarakat.',
                'penulis' => 'Tim Operasional KAI',
                'tanggal' => Carbon::now()->subDays(10)
            ],
            [
                'judul' => 'KAI Terapkan Sistem Keamanan Berbasis AI',
                'isi' => 'PT Kereta Api Indonesia (Persero) menerapkan sistem keamanan berbasis Artificial Intelligence (AI) untuk meningkatkan keamanan dan keselamatan penumpang serta aset perusahaan.

Sistem AI ini mampu mendeteksi aktivitas mencurigakan, memantau kondisi infrastruktur secara real-time, dan memberikan peringatan dini terhadap potensi gangguan keamanan.

"Teknologi AI membantu kami memberikan layanan yang lebih aman dan efisien," ujar Direktur Keamanan KAI. "Sistem ini bekerja 24/7 tanpa lelah untuk melindungi semua aspek operasional."

Fitur-fitur sistem keamanan AI meliputi:
- Facial recognition untuk identifikasi penumpang
- Deteksi objek mencurigakan
- Monitoring kondisi rel dan sinyal
- Prediksi maintenance preventif
- Sistem alarm otomatis

Implementasi sistem ini telah mengurangi insiden keamanan hingga 85% dan meningkatkan respons time terhadap situasi darurat.',
                'penulis' => 'Departemen Keamanan KAI',
                'tanggal' => Carbon::now()->subDays(12)
            ],
            [
                'judul' => 'KAI Komitmen Net Zero Carbon pada 2030',
                'isi' => 'PT Kereta Api Indonesia (Persero) mengumumkan komitmen untuk mencapai Net Zero Carbon pada tahun 2030 sebagai bagian dari tanggung jawab sosial dan lingkungan perusahaan.

"Kami berkomitmen untuk menjadi perusahaan transportasi yang ramah lingkungan," tegas Direktur Utama KAI. "Ini adalah tanggung jawab kami untuk generasi mendatang."

Strategi yang akan diimplementasikan meliputi:
- Penggunaan energi terbarukan untuk operasional
- Optimasi rute untuk efisiensi bahan bakar
- Program reforestasi di sekitar jalur kereta api
- Penggunaan material ramah lingkungan
- Sistem waste management yang terintegrasi

KAI telah memulai dengan mengkonversi 30% armada kereta api untuk menggunakan energi listrik dan menargetkan 100% pada 2028. Program ini didukung oleh investasi sebesar Rp 5 triliun dalam 5 tahun ke depan.

"Transportasi kereta api sudah merupakan moda transportasi yang relatif ramah lingkungan," tambah Direktur Lingkungan KAI. "Dengan program ini, kami akan menjadi yang terdepan dalam sustainable transportation."',
                'penulis' => 'Departemen CSR KAI',
                'tanggal' => Carbon::now()->subDays(15)
            ]
        ];

        foreach ($newsData as $data) {
            $news = new KaiNews();
            $news->id = $news->newUniqueId();
            $news->judul = $data['judul'];
            $news->isi = $data['isi'];
            $news->penulis = $data['penulis'];
            $news->tanggal = $data['tanggal'];
            $news->gambar = $data['gambar'] ?? null;
            $news->save();
            
            // Add small delay to ensure different UUIDs
            usleep(1000); // 1ms delay
        }
    }
}
