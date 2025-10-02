@extends('layouts.app')

@section('title', 'Layanan - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Slideshow -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000" 
         style="background-image: url('https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
    </div>
    
    
    <div class="relative z-10 container mx-auto px-4 text-center text-kai-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    Layanan
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Layanan Utama Kami
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up">
            Berbagai layanan transportasi kereta api yang memenuhi kebutuhan perjalanan Anda dengan standar internasional
            </p>
            
            <!-- Scroll Indicator -->
            <div class="mt-12 animate-bounce">
                <div class="flex flex-col items-center text-kai-white cursor-pointer" @click="window.scrollTo({ top: window.innerHeight, behavior: 'smooth' })">
                    <span class="text-sm mb-2">Scroll ke bawah</span>
                    <i class="fas fa-chevron-down text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Grid Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        @if($services && $services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($services as $service)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105 group" x-data="{ showDetails: false }">
                <!-- Service Image -->
                <div class="h-48 bg-gradient-to-r from-kai-blue to-kai-orange flex items-center justify-center">
                    @if($service->gambar)
                        <img src="{{ asset('storage/' . $service->gambar) }}" alt="{{ $service->nama_layanan }}" class="w-full h-full object-cover">
                    @else
                        <i class="{{ $service->icon ?? 'fas fa-train' }} text-white text-6xl group-hover:scale-110 transition-transform duration-300"></i>
                    @endif
                </div>
                
                <!-- Service Content -->
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        @if(!$service->gambar)
                        <div class="bg-kai-orange text-white rounded-full w-12 h-12 flex items-center justify-center mr-4">
                            <i class="{{ $service->icon ?? 'fas fa-train' }}"></i>
                        </div>
                        @endif
                        <h3 class="text-xl font-semibold text-kai-blue group-hover:text-kai-orange transition-colors duration-300">
                            {{ $service->nama_layanan }}
                        </h3>
                    </div>
                    
                    <p class="text-gray-600 mb-4" x-show="!showDetails">
                        {{ Str::limit($service->deskripsi, 120) }}
                    </p>
                    
                    <div x-show="showDetails" x-transition class="text-gray-600 mb-4">
                        {{ $service->deskripsi }}
                    </div>
                    
                    <button @click="showDetails = !showDetails" 
                            class="text-kai-orange hover:text-orange-600 font-semibold transition-colors duration-300">
                        <span x-show="!showDetails">Baca Selengkapnya <i class="fas fa-chevron-down ml-1"></i></span>
                        <span x-show="showDetails">Tutup <i class="fas fa-chevron-up ml-1"></i></span>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Default Services Content -->
        <div class="text-center py-16">
            <div class="bg-white rounded-lg shadow-lg p-12 max-w-md mx-auto">
                <i class="fas fa-train text-6xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-semibold text-gray-600 mb-4">Data Layanan Belum Tersedia</h3>
                <p class="text-gray-500">Informasi layanan KAI akan segera tersedia.</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Service Categories Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-kai-blue mb-4">Kategori Layanan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Pilih kategori layanan sesuai dengan kebutuhan perjalanan Anda
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Passenger Services -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group">
                <div class="bg-kai-blue text-white rounded-full w-20 h-20 flex items-center justify-center text-3xl mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-3">Layanan Penumpang</h3>
                <p class="text-gray-600 text-sm">
                    Layanan kereta api untuk penumpang dengan berbagai kelas dan fasilitas
                </p>
            </div>
            
            <!-- Cargo Services -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group">
                <div class="bg-kai-orange text-white rounded-full w-20 h-20 flex items-center justify-center text-3xl mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-boxes"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-3">Layanan Kargo</h3>
                <p class="text-gray-600 text-sm">
                    Pengiriman barang dan kargo dengan sistem logistik yang terintegrasi
                </p>
            </div>
            
            <!-- Commuter Services -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group">
                <div class="bg-kai-blue text-white rounded-full w-20 h-20 flex items-center justify-center text-3xl mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-subway"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-3">Commuter</h3>
                <p class="text-gray-600 text-sm">
                    Layanan kereta commuter untuk perjalanan sehari-hari yang praktis
                </p>
            </div>
            
            <!-- Tourism Services -->
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group">
                <div class="bg-kai-orange text-white rounded-full w-20 h-20 flex items-center justify-center text-3xl mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-camera"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-3">Pariwisata</h3>
                <p class="text-gray-600 text-sm">
                    Layanan kereta wisata dengan pemandangan indah dan fasilitas lengkap
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Service Features Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-kai-blue mb-4">Keunggulan Layanan KAI</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Mengapa memilih layanan transportasi kereta api KAI?
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Safety -->
            <div class="text-center p-8 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="bg-green-500 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-6">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-4">Aman & Terpercaya</h3>
                <p class="text-gray-600">
                    Sistem keselamatan berstandar internasional dengan teknologi terdepan untuk memastikan perjalanan yang aman.
                </p>
            </div>
            
            <!-- Comfort -->
            <div class="text-center p-8 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="bg-blue-500 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-6">
                    <i class="fas fa-couch"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-4">Nyaman & Modern</h3>
                <p class="text-gray-600">
                    Fasilitas modern dengan kenyamanan maksimal untuk pengalaman perjalanan yang tak terlupakan.
                </p>
            </div>
            
            <!-- Punctual -->
            <div class="text-center p-8 bg-white rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="bg-orange-500 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-6">
                    <i class="fas fa-clock"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-4">Tepat Waktu</h3>
                <p class="text-gray-600">
                    Komitmen tinggi terhadap ketepatan waktu untuk memastikan perjalanan sesuai jadwal.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Booking CTA Section -->
<section class="py-16 bg-gradient-to-r from-kai-blue to-blue-800">
    <div class="container mx-auto px-4 text-center text-kai-white">
        <h2 class="text-4xl font-bold mb-6">Siap Memulai Perjalanan?</h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Pesan tiket kereta api Anda sekarang dan nikmati perjalanan yang aman, nyaman, dan terpercaya
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="#" class="bg-kai-orange hover:bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-ticket-alt mr-2"></i>
                Pesan Tiket Online
            </a>
            <a href="{{ route('contact') }}" class="border-2 border-white text-white hover:bg-white hover:text-kai-blue px-8 py-3 rounded-lg font-semibold transition-all duration-300">
                <i class="fas fa-phone mr-2"></i>
                Hubungi Customer Service
            </a>
        </div>
    </div>
</section>

<!-- Service Information Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Service Hours -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-semibold text-kai-blue mb-6">
                    <i class="fas fa-clock mr-2"></i>
                    Jam Layanan
                </h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium">Customer Service</span>
                        <span class="text-gray-600">24 Jam</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium">Pemesanan Tiket Online</span>
                        <span class="text-gray-600">24 Jam</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-200">
                        <span class="font-medium">Layanan Kereta</span>
                        <span class="text-gray-600">05:00 - 24:00</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="font-medium">Informasi Jadwal</span>
                        <span class="text-gray-600">24 Jam</span>
                    </div>
                </div>
            </div>
            
            <!-- Contact Information -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h3 class="text-2xl font-semibold text-kai-blue mb-6">
                    <i class="fas fa-phone mr-2"></i>
                    Hubungi Kami
                </h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-phone text-kai-orange text-xl mr-4"></i>
                        <div>
                            <div class="font-medium">Customer Service</div>
                            <div class="text-gray-600">1500000</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-kai-orange text-xl mr-4"></i>
                        <div>
                            <div class="font-medium">Email</div>
                            <div class="text-gray-600">info@kai.id</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fab fa-whatsapp text-kai-orange text-xl mr-4"></i>
                        <div>
                            <div class="font-medium">WhatsApp</div>
                            <div class="text-gray-600">+62 811-1500-000</div>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <i class="fas fa-map-marker-alt text-kai-orange text-xl mr-4 mt-1"></i>
                        <div>
                            <div class="font-medium">Alamat</div>
                            <div class="text-gray-600">
                                @if($profile)
                                    {{ $profile->alamat }}
                                @else
                                    Jl. Perintis Kemerdekaan No. 1, Bandung 40117
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

