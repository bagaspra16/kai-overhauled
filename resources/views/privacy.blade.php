@extends('layouts.app')

@section('title', 'Kebijakan Privasi - PT Kereta Api Indonesia')

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
                    Privasi
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Kebijakan Privasi
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up">
                Komitmen kami dalam melindungi data pribadi dan privasi pengguna layanan PT KAI
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
                        <i class="fas fa-shield-alt text-kai-blue text-2xl"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-kai-blue">Komitmen Privasi Kami</h2>
                </div>
                <p class="text-gray-700 leading-relaxed text-lg">
                    PT Kereta Api Indonesia (KAI) berkomitmen untuk melindungi privasi dan keamanan data pribadi Anda. 
                    Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda.
                </p>
                <div class="mt-4 p-4 bg-kai-orange/10 rounded-lg">
                    <p class="text-kai-orange font-semibold">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        Terakhir diperbarui: {{ date('d F Y') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Privacy Content -->
        <div class="mx-auto space-y-10 lg:space-y-12">
            
            <!-- 1. Informasi yang Kami Kumpulkan -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">1</span>
                    Informasi yang Kami Kumpulkan
                </h3>
                <div class="space-y-6">
                    <div class="grid md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-8 lg:gap-12">
                        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 lg:p-10 rounded-lg">
                            <h4 class="font-semibold text-kai-blue mb-3 flex items-center">
                                <i class="fas fa-user mr-2"></i>
                                Data Pribadi
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li>• Nama lengkap dan identitas</li>
                                <li>• Nomor telepon dan email</li>
                                <li>• Alamat tempat tinggal</li>
                                <li>• Tanggal lahir</li>
                                <li>• Nomor identitas (KTP/Paspor)</li>
                            </ul>
                        </div>
                        <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 lg:p-10 rounded-lg">
                            <h4 class="font-semibold text-kai-blue mb-3 flex items-center">
                                <i class="fas fa-ticket-alt mr-2"></i>
                                Data Transaksi
                            </h4>
                            <ul class="space-y-2 text-sm text-gray-700">
                                <li>• Riwayat pemesanan tiket</li>
                                <li>• Informasi pembayaran</li>
                                <li>• Preferensi perjalanan</li>
                                <li>• Data lokasi keberangkatan</li>
                                <li>• Feedback dan rating</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Penggunaan Informasi -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">2</span>
                    Penggunaan Informasi
                </h3>
                <div class="space-y-8">
                    <div class="text-center">
                        <p class="text-gray-700 leading-relaxed text-lg max-w-4xl mx-auto">
                            Kami menggunakan informasi Anda untuk tujuan-tujuan berikut:
                        </p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-8 lg:gap-10">
                        <div class="text-center p-8 bg-kai-blue/5 rounded-xl hover:bg-kai-blue/10 transition-colors duration-300 h-full flex flex-col">
                            <div class="bg-kai-blue/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-cogs text-kai-blue text-3xl"></i>
                            </div>
                            <h4 class="font-bold text-kai-blue mb-3 text-lg">Operasional Layanan</h4>
                            <p class="text-gray-600 leading-relaxed flex-grow">Pemrosesan informasi tiket, konfirmasi jadwal perjalanan, dan layanan bantuan pelanggan</p>
                        </div>
                        <div class="text-center p-8 bg-kai-orange/5 rounded-xl hover:bg-kai-orange/10 transition-colors duration-300 h-full flex flex-col">
                            <div class="bg-kai-orange/10 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-kai-orange text-3xl"></i>
                            </div>
                            <h4 class="font-bold text-kai-orange mb-3 text-lg">Peningkatan Layanan</h4>
                            <p class="text-gray-600 leading-relaxed flex-grow">Analisis data untuk meningkatkan kualitas informasi dan efisiensi sistem pencarian</p>
                        </div>
                        <div class="text-center p-8 bg-green-50 rounded-xl hover:bg-green-100 transition-colors duration-300 h-full flex flex-col md:col-span-2 lg:col-span-1">
                            <div class="bg-green-100 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-bell text-green-600 text-3xl"></i>
                            </div>
                            <h4 class="font-bold text-green-600 mb-3 text-lg">Komunikasi</h4>
                            <p class="text-gray-600 leading-relaxed flex-grow">Notifikasi perubahan jadwal, informasi penting, dan update layanan transportasi</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3. Perlindungan Data -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">3</span>
                    Perlindungan Data
                </h3>
                <div class="space-y-6">
                    <p class="text-gray-700 leading-relaxed">
                        Kami menerapkan langkah-langkah keamanan yang ketat untuk melindungi data pribadi Anda:
                    </p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="bg-green-100 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-lock text-green-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Enkripsi Data</h4>
                                    <p class="text-sm text-gray-600">Data sensitif dienkripsi menggunakan standar industri</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-blue-100 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-server text-blue-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Server Aman</h4>
                                    <p class="text-sm text-gray-600">Infrastruktur server dengan keamanan berlapis</p>
                                </div>
                            </div>
                        </div>
                        <div class="space-y-4">
                            <div class="flex items-start">
                                <div class="bg-purple-100 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-user-shield text-purple-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Akses Terbatas</h4>
                                    <p class="text-sm text-gray-600">Hanya personel berwenang yang dapat mengakses data</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <div class="bg-red-100 p-2 rounded-full mr-3 mt-1">
                                    <i class="fas fa-eye text-red-600"></i>
                                </div>
                                <div>
                                    <h4 class="font-semibold text-gray-800">Monitoring 24/7</h4>
                                    <p class="text-sm text-gray-600">Pemantauan keamanan sistem secara berkelanjutan</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Berbagi Informasi -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">4</span>
                    Berbagi Informasi
                </h3>
                <div class="space-y-4">
                    <div class="bg-red-50 border border-red-200 p-4 rounded-lg">
                        <h4 class="font-semibold text-red-800 mb-2 flex items-center">
                            <i class="fas fa-exclamation-triangle mr-2"></i>
                            Prinsip Utama
                        </h4>
                        <p class="text-red-700 text-sm">
                            KAI TIDAK akan menjual, menyewakan, atau membagikan data pribadi Anda kepada pihak ketiga 
                            tanpa persetujuan eksplisit, kecuali dalam kondisi tertentu yang diatur oleh hukum.
                        </p>
                    </div>
                    <div class="space-y-3">
                        <h4 class="font-semibold text-gray-800">Pengecualian yang Diizinkan:</h4>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="flex items-start">
                                <i class="fas fa-gavel text-kai-blue mt-1 mr-3"></i>
                                <div>
                                    <span class="font-medium">Kewajiban Hukum</span>
                                    <p class="text-sm text-gray-600">Permintaan resmi dari penegak hukum</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-handshake text-kai-blue mt-1 mr-3"></i>
                                <div>
                                    <span class="font-medium">Mitra Layanan</span>
                                    <p class="text-sm text-gray-600">Penyedia layanan pembayaran dan logistik</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 5. Hak Pengguna -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">5</span>
                    Hak-Hak Anda
                </h3>
                <div class="space-y-4">
                    <p class="text-gray-700 leading-relaxed">
                        Sebagai pengguna, Anda memiliki hak-hak berikut terkait data pribadi:
                    </p>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-blue-50 rounded-lg">
                                <i class="fas fa-eye text-blue-600 mr-3"></i>
                                <span class="font-medium text-blue-800">Hak Akses</span>
                            </div>
                            <div class="flex items-center p-3 bg-green-50 rounded-lg">
                                <i class="fas fa-edit text-green-600 mr-3"></i>
                                <span class="font-medium text-green-800">Hak Perbaikan</span>
                            </div>
                            <div class="flex items-center p-3 bg-red-50 rounded-lg">
                                <i class="fas fa-trash text-red-600 mr-3"></i>
                                <span class="font-medium text-red-800">Hak Penghapusan</span>
                            </div>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-center p-3 bg-purple-50 rounded-lg">
                                <i class="fas fa-download text-purple-600 mr-3"></i>
                                <span class="font-medium text-purple-800">Hak Portabilitas</span>
                            </div>
                            <div class="flex items-center p-3 bg-yellow-50 rounded-lg">
                                <i class="fas fa-ban text-yellow-600 mr-3"></i>
                                <span class="font-medium text-yellow-800">Hak Pembatasan</span>
                            </div>
                            <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                <i class="fas fa-times-circle text-gray-600 mr-3"></i>
                                <span class="font-medium text-gray-800">Hak Keberatan</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 6. Cookies dan Teknologi Pelacakan -->
            <div class="bg-white rounded-2xl shadow-lg p-10 lg:p-12 hover:shadow-xl transition-shadow duration-300">
                <h3 class="text-2xl font-bold text-kai-blue mb-6 flex items-center">
                    <span class="bg-kai-blue text-white w-8 h-8 rounded-full flex items-center justify-center text-sm mr-3">6</span>
                    Cookies dan Pelacakan
                </h3>
                <div class="space-y-4">
                    <p class="text-gray-700 leading-relaxed">
                        Kami menggunakan cookies dan teknologi serupa untuk meningkatkan pengalaman pengguna:
                    </p>
                    <div class="grid md:grid-cols-3 gap-4">
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <i class="fas fa-cog text-kai-blue text-2xl mb-3"></i>
                            <h4 class="font-semibold text-kai-blue mb-2">Cookies Fungsional</h4>
                            <p class="text-sm text-gray-600">Menyimpan preferensi dan pengaturan</p>
                        </div>
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <i class="fas fa-chart-bar text-kai-orange text-2xl mb-3"></i>
                            <h4 class="font-semibold text-kai-orange mb-2">Cookies Analitik</h4>
                            <p class="text-sm text-gray-600">Memahami penggunaan website</p>
                        </div>
                        <div class="text-center p-4 border border-gray-200 rounded-lg">
                            <i class="fas fa-shield-alt text-green-600 text-2xl mb-3"></i>
                            <h4 class="font-semibold text-green-600 mb-2">Cookies Keamanan</h4>
                            <p class="text-sm text-gray-600">Melindungi dari aktivitas mencurigakan</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Contact Section -->
        <div class="mx-auto mt-12">
            <div class="bg-gradient-to-r from-kai-blue to-kai-orange rounded-2xl p-8 text-white text-center">
                <h3 class="text-2xl font-bold mb-4">Pertanyaan tentang Privasi?</h3>
                <p class="mb-6">Hubungi Data Protection Officer kami untuk informasi lebih lanjut</p>
                <div class="flex flex-col md:flex-row justify-center items-center space-y-4 md:space-y-0 md:space-x-8">
                    <div class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-xl"></i>
                        <span class="font-semibold">privacy@kai.id</span>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone mr-3 text-xl"></i>
                        <span class="font-semibold">1500000 (ext. 123)</span>
                    </div>
                </div>
                <div class="mt-6 p-4 bg-white/10 rounded-lg">
                    <p class="text-sm">
                        <i class="fas fa-clock mr-2"></i>
                        Kami akan merespons pertanyaan privasi dalam waktu maksimal 30 hari kerja
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
