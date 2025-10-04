@extends('layouts.app')

@section('title', 'Syarat dan Ketentuan - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ asset('assets/kai-background-1.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
    </div>
    
    <div class="relative z-10 container mx-auto px-4 text-center text-kai-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    Legal
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Syarat & Ketentuan
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up">
                Ketentuan penggunaan layanan transportasi kereta api PT KAI yang berlaku untuk semua pengguna
            </p>
            
            <!-- Scroll Indicator -->
            <div class="mt-12 animate-bounce">
                <div class="flex flex-col items-center text-kai-white cursor-pointer" @click="window.scrollTo({ top: window.innerHeight, behavior: 'smooth' })">
                    <span class="text-sm mb-2">Geser ke bawah</span>
                    <i class="fas fa-chevron-down text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Content Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Introduction -->
        <div class="mx-auto mb-12">
            <div class="bg-white rounded-2xl shadow-lg p-8 border-l-4 border-kai-blue">
                <div class="flex items-center mb-6">
                    <div class="bg-kai-blue/10 p-3 rounded-full mr-4">
                        <i class="fas fa-info-circle text-kai-blue text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-kai-blue">Informasi Penting</h2>
                </div>
                <p class="text-gray-700 leading-relaxed text-lg">
                    Dengan menggunakan layanan PT Kereta Api Indonesia (KAI), Anda menyetujui untuk terikat dengan syarat dan ketentuan berikut. 
                    Harap membaca dengan seksama sebelum menggunakan layanan kami.
                </p>
                <div class="mt-4 p-4 bg-kai-orange/10 rounded-lg">
                    <p class="text-kai-orange font-semibold">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Terakhir diperbarui: {{ date('d F Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Terms Content -->
        <div class="mx-auto space-y-10 lg:space-y-12">
            
            <!-- 1. Definisi -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">1</span>
                    Definisi
                </h3>
                <div class="space-y-6 text-gray-700">
                    <div class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8 lg:gap-12">
                        <div class="border-l-4 border-kai-blue pl-8">
                            <h4 class="font-semibold text-kai-blue mb-3">Definisi Umum:</h4>
                            <div class="space-y-2 text-sm">
                                <p><strong>"KAI"</strong> - PT Kereta Api Indonesia (Persero)</p>
                                <p><strong>"Pengguna"</strong> - Setiap orang yang mengakses dan menggunakan website ini</p>
                                <p><strong>"Layanan"</strong> - Seluruh layanan transportasi kereta api dan digital yang disediakan KAI</p>
                                <p><strong>"Tiket"</strong> - Bukti pembayaran yang sah untuk menggunakan layanan transportasi KAI</p>
                            </div>
                        </div>
                        <div class="border-l-4 border-kai-orange pl-8">
                            <h4 class="font-semibold text-kai-orange mb-3">Definisi Digital:</h4>
                            <div class="space-y-2 text-sm">
                                <p><strong>"Website"</strong> - Platform digital KAI untuk informasi jadwal dan harga tiket</p>
                                <p><strong>"Chatbot"</strong> - Asisten virtual untuk bantuan navigasi dan informasi</p>
                                <p><strong>"Pencarian Tiket"</strong> - Fitur untuk mencari informasi jadwal dan harga kereta</p>
                                <p><strong>"Informasi"</strong> - Data jadwal, harga, dan detail perjalanan kereta api</p>
                                <p><strong>"Pengguna"</strong> - Pengunjung website yang mengakses informasi transportasi</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Penggunaan Website dan Fitur Digital -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">2</span>
                    Penggunaan Website dan Fitur Digital
                </h3>
                <div class="space-y-6 text-gray-700">
                    <!-- Website Usage -->
                    <div class="bg-blue-50 p-8 lg:p-10 rounded-lg">
                        <h4 class="font-semibold text-kai-blue mb-3 flex items-center">
                            <i class="fas fa-globe mr-2"></i>
                            Penggunaan Website KAI
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i>
                                <span>Website ini disediakan untuk informasi dan pemesanan tiket kereta api</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i>
                                <span>Pengguna bertanggung jawab atas keamanan akun dan password</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check text-green-500 mt-1 mr-2 text-xs"></i>
                                <span>Dilarang menggunakan website untuk tujuan ilegal atau merugikan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Ticket Search Feature -->
                    <div class="bg-orange-50 p-8 lg:p-10 rounded-lg">
                        <h4 class="font-semibold text-kai-orange mb-3 flex items-center">
                            <i class="fas fa-search mr-2"></i>
                            Fitur Pencarian Tiket
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-ticket-alt text-kai-orange mt-1 mr-2 text-xs"></i>
                                <span>Informasi jadwal dan harga yang ditampilkan bersifat real-time</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-clock text-kai-orange mt-1 mr-2 text-xs"></i>
                                <span>Ketersediaan kursi dapat berubah sewaktu-waktu</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-map-marker-alt text-kai-orange mt-1 mr-2 text-xs"></i>
                                <span>Pengguna wajib memverifikasi stasiun keberangkatan dan tujuan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Chatbot Service -->
                    <div class="bg-green-50 p-8 lg:p-10 rounded-lg">
                        <h4 class="font-semibold text-green-600 mb-3 flex items-center">
                            <i class="fas fa-robot mr-2"></i>
                            Layanan Chatbot KAI Assistant
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-comments text-green-600 mt-1 mr-2 text-xs"></i>
                                <span>Chatbot menyediakan informasi umum dan bantuan navigasi website</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-database text-green-600 mt-1 mr-2 text-xs"></i>
                                <span>Riwayat percakapan disimpan untuk meningkatkan layanan</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-user-shield text-green-600 mt-1 mr-2 text-xs"></i>
                                <span>Jangan bagikan informasi pribadi sensitif melalui chatbot</span>
                            </li>
                        </ul>
                    </div>

                    <!-- News and Information -->
                    <div class="bg-purple-50 p-8 lg:p-10 rounded-lg">
                        <h4 class="font-semibold text-purple-600 mb-3 flex items-center">
                            <i class="fas fa-newspaper mr-2"></i>
                            Berita dan Informasi
                        </h4>
                        <ul class="space-y-2 text-sm">
                            <li class="flex items-start">
                                <i class="fas fa-info-circle text-purple-600 mt-1 mr-2 text-xs"></i>
                                <span>Informasi berita dan pengumuman bersifat resmi dari KAI</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-calendar text-purple-600 mt-1 mr-2 text-xs"></i>
                                <span>Jadwal dan perubahan operasional akan diumumkan melalui website</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- 3. Sistem Informasi Jadwal dan Harga Tiket -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">3</span>
                    Sistem Informasi Jadwal dan Harga Tiket
                </h3>
                <div class="space-y-6 text-gray-700">
                    <!-- Information System -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-kai-blue mb-4 flex items-center">
                            <i class="fas fa-info-circle mr-2"></i>
                            Fitur Informasi Jadwal dan Harga
                        </h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Pencarian Informasi:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-route text-kai-blue mt-1 mr-2 text-xs"></i>
                                        <span>Pilih stasiun asal dan tujuan untuk melihat rute yang tersedia</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-calendar-day text-kai-blue mt-1 mr-2 text-xs"></i>
                                        <span>Tentukan tanggal untuk melihat jadwal keberangkatan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-users text-kai-blue mt-1 mr-2 text-xs"></i>
                                        <span>Pilih jumlah penumpang untuk kalkulasi harga total</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Informasi yang Ditampilkan:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-clock text-kai-orange mt-1 mr-2 text-xs"></i>
                                        <span>Jadwal keberangkatan dan kedatangan yang akurat</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-money-bill text-kai-orange mt-1 mr-2 text-xs"></i>
                                        <span>Harga tiket berdasarkan kelas dan jenis penumpang</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-train text-kai-orange mt-1 mr-2 text-xs"></i>
                                        <span>Informasi nama kereta dan kelas yang tersedia</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-map-marker-alt text-kai-orange mt-1 mr-2 text-xs"></i>
                                        <span>Detail stasiun keberangkatan dan tujuan</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Information Disclaimer -->
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-yellow-700 mb-4 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Penting untuk Diketahui
                        </h4>
                        <div class="grid md:grid-cols-1 gap-4">
                            <div class="bg-white p-4 rounded-lg border-l-4 border-yellow-500">
                                <ul class="space-y-2 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-info text-yellow-600 mt-1 mr-2 text-xs"></i>
                                        <span><strong>Website ini hanya menyediakan informasi</strong> jadwal dan harga tiket kereta api</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-ban text-red-600 mt-1 mr-2 text-xs"></i>
                                        <span><strong>Tidak tersedia fitur pemesanan</strong> atau pembelian tiket secara online</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-store text-blue-600 mt-1 mr-2 text-xs"></i>
                                        <span>Untuk pemesanan tiket, silakan kunjungi <strong>loket stasiun</strong> atau <strong>aplikasi resmi KAI</strong></span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-clock text-green-600 mt-1 mr-2 text-xs"></i>
                                        <span>Informasi jadwal dan harga dapat berubah sewaktu-waktu tanpa pemberitahuan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-phone text-purple-600 mt-1 mr-2 text-xs"></i>
                                        <span>Untuk informasi terkini, hubungi call center KAI di <strong>1500000</strong></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Layanan Digital dan Keamanan Data -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">4</span>
                    Layanan Digital dan Keamanan Data
                </h3>
                <div class="space-y-6 text-gray-700">
                    <!-- Digital Services -->
                    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-cyan-700 mb-4 flex items-center">
                            <i class="fas fa-digital-tachograph mr-2"></i>
                            Layanan Digital KAI
                        </h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Fitur Informasi:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-newspaper text-cyan-600 mt-1 mr-2 text-xs"></i>
                                        <span>Berita dan pengumuman resmi KAI</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-info-circle text-cyan-600 mt-1 mr-2 text-xs"></i>
                                        <span>Informasi layanan dan fasilitas</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-phone text-cyan-600 mt-1 mr-2 text-xs"></i>
                                        <span>Kontak dan customer service</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Fitur Interaktif:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-robot text-cyan-600 mt-1 mr-2 text-xs"></i>
                                        <span>Chatbot untuk bantuan navigasi</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-search text-cyan-600 mt-1 mr-2 text-xs"></i>
                                        <span>Pencarian jadwal dan rute real-time</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-mobile-alt text-cyan-600 mt-1 mr-2 text-xs"></i>
                                        <span>Interface responsif untuk semua perangkat</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Data Security -->
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-red-700 mb-4 flex items-center">
                            <i class="fas fa-shield-alt mr-2"></i>
                            Keamanan dan Privasi Data
                        </h4>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Perlindungan Data:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-lock text-red-600 mt-1 mr-2 text-xs"></i>
                                        <span>Enkripsi SSL untuk semua transaksi</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-server text-red-600 mt-1 mr-2 text-xs"></i>
                                        <span>Server aman dengan backup otomatis</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-user-shield text-red-600 mt-1 mr-2 text-xs"></i>
                                        <span>Akses data terbatas sesuai kebutuhan</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Hak Pengguna:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-eye text-red-600 mt-1 mr-2 text-xs"></i>
                                        <span>Hak akses dan koreksi data pribadi</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-trash text-red-600 mt-1 mr-2 text-xs"></i>
                                        <span>Hak penghapusan data sesuai permintaan</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-download text-red-600 mt-1 mr-2 text-xs"></i>
                                        <span>Hak portabilitas data</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- User Responsibilities -->
                    <div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-6 rounded-lg">
                        <h4 class="font-semibold text-yellow-700 mb-4 flex items-center">
                            <i class="fas fa-user-cog mr-2"></i>
                            Tanggung Jawab Pengguna Website
                        </h4>
                        <div class="grid md:grid-cols-3 gap-4">
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Keamanan Akun:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-key text-yellow-600 mt-1 mr-2 text-xs"></i>
                                        <span>Menjaga kerahasiaan password</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-sign-out-alt text-yellow-600 mt-1 mr-2 text-xs"></i>
                                        <span>Logout setelah selesai menggunakan</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Penggunaan Wajar:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-ban text-yellow-600 mt-1 mr-2 text-xs"></i>
                                        <span>Tidak menyalahgunakan sistem</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-bug text-yellow-600 mt-1 mr-2 text-xs"></i>
                                        <span>Melaporkan bug atau error</span>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <h5 class="font-medium text-gray-800 mb-2">Data Akurat:</h5>
                                <ul class="space-y-1 text-sm">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-double text-yellow-600 mt-1 mr-2 text-xs"></i>
                                        <span>Memberikan informasi yang benar</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-edit text-yellow-600 mt-1 mr-2 text-xs"></i>
                                        <span>Memperbarui data jika berubah</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Perubahan Ketentuan -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">5</span>
                    Perubahan Ketentuan
                </h3>
                <div class="space-y-4 text-gray-700">
                    <p class="leading-relaxed">
                        KAI berhak mengubah syarat dan ketentuan ini sewaktu-waktu. Perubahan akan diumumkan melalui 
                        website resmi dan berlaku efektif setelah publikasi. Pengguna disarankan untuk memeriksa 
                        pembaruan secara berkala.
                    </p>
                    <div class="bg-kai-blue/10 p-4 rounded-lg">
                        <p class="text-kai-blue font-semibold">
                            <i class="fas fa-bell mr-2"></i>
                            Pemberitahuan perubahan akan dikirim melalui email terdaftar
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <!-- Contact Section -->
        <div class="mx-auto mt-12">
            <div class="bg-gradient-to-r from-kai-blue to-kai-orange rounded-2xl p-8 text-white text-center">
                <h3 class="text-2xl font-bold mb-4">Butuh Bantuan?</h3>
                <p class="mb-6">Hubungi customer service kami untuk pertanyaan lebih lanjut</p>
                <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-8">
                    <div class="flex items-center">
                        <i class="fas fa-phone mr-3 text-xl"></i>
                        <span class="font-semibold">1500000</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-xl"></i>
                        <span class="font-semibold">info@kai.id</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
