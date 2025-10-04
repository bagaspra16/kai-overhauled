@extends('layouts.app')

@section('title', 'Tentang KAI - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Slideshow -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000" 
         style="background-image: url('{{ asset('assets/kai-background-1.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
    </div>
    
    
    <div class="relative z-10 container mx-auto px-4 text-center text-kai-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    Tentang
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Perjalanan Panjang Kami
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up">
                Menghubungkan Nusantara dengan layanan transportasi kereta api yang aman, nyaman, dan terpercaya sejak 1945
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

<!-- Company Profile Section -->
@if($profile)
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div>
                <h2 class="text-4xl font-bold text-kai-blue mb-6">Profil Perusahaan</h2>
                <div class="space-y-6">
                    <div>
                        <h3 class="text-xl font-semibold text-kai-blue mb-2">Visi</h3>
                        <p class="text-gray-600">{{ $profile->visi }}</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-kai-blue mb-2">Misi</h3>
                        <p class="text-gray-600">{{ $profile->misi }}</p>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-kai-blue mb-2">Slogan</h3>
                        <p class="text-gray-600 font-semibold">{{ $profile->slogan }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-r from-kai-blue to-kai-orange rounded-lg p-8 text-white">
                <h3 class="text-2xl font-bold mb-6">Informasi Kontak</h3>
                <div class="space-y-4">
                    <div class="flex items-center">
                        <i class="fas fa-building text-2xl mr-4"></i>
                        <div>
                            <div class="font-semibold">Nama Perusahaan</div>
                            <div class="text-gray-200">{{ $profile->nama_perusahaan }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-2xl mr-4"></i>
                        <div>
                            <div class="font-semibold">Alamat</div>
                            <div class="text-gray-200">{{ $profile->alamat }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-envelope text-2xl mr-4"></i>
                        <div>
                            <div class="font-semibold">Email</div>
                            <div class="text-gray-200">{{ $profile->email }}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <i class="fas fa-phone text-2xl mr-4"></i>
                        <div>
                            <div class="font-semibold">Telepon</div>
                            <div class="text-gray-200">{{ $profile->telepon }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Timeline Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-100 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%232c2a6b" fill-opacity="0.1"%3E%3Cpath d="M50 0L60 40H100L70 60L80 100L50 80L20 100L30 60L0 40H40Z"/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10" x-data="{ activeItem: 0 }">
        <div class="text-center mb-16">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider">Sejarah & Perkembangan</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-kai-blue mb-6">
                Perjalanan Panjang KAI
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Perjalanan panjang PT Kereta Api Indonesia dalam menghubungkan seluruh Nusantara
            </p>
        </div>
        
        @if($aboutItems && $aboutItems->count() > 0)
        <!-- Timeline Navigation -->
        <div class="flex flex-wrap justify-center gap-4 mb-16">
            @foreach($aboutItems as $index => $item)
            <button @click="activeItem = {{ $index }}" 
                    :class="activeItem === {{ $index }} ? 'bg-gradient-to-r from-kai-orange to-kai-orange-light text-white shadow-2xl scale-105' : 'bg-white text-kai-blue hover:bg-gray-50 shadow-lg'"
                    class="group relative px-8 py-4 rounded-full font-bold transition-all duration-500 transform hover:scale-105 hover:-translate-y-1">
                <span class="relative z-10">{{ $item->tahun }}</span>
                <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-30 transition duration-300" :class="activeItem === {{ $index }} ? 'opacity-50' : ''"></div>
            </button>
            @endforeach
        </div>
        
        <!-- Timeline Content -->
        <div class="relative">
            @foreach($aboutItems as $index => $item)
            <div x-show="activeItem === {{ $index }}" 
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 transform translate-y-8 scale-95"
                 x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 transform translate-y-8 scale-95"
                 class="bg-white rounded-3xl shadow-2xl p-10 border border-gray-100">
                <div class="flex flex-col lg:flex-row items-start lg:items-center mb-8">
                    <div class="relative mb-6 lg:mb-0 lg:mr-8">
                        <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white rounded-2xl w-24 h-24 flex items-center justify-center text-3xl font-bold shadow-lg">
                            {{ $item->tahun }}
                        </div>
                        <div class="absolute -inset-2 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-2xl blur opacity-20"></div>
                    </div>
                    <div class="flex-1">
                        <h3 class="text-3xl font-bold text-kai-blue mb-4">{{ $item->judul }}</h3>
                        <div class="w-32 h-2 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full"></div>
                    </div>
                </div>
                <div class="prose prose-lg max-w-none">
                    <p class="text-gray-600 text-xl leading-relaxed">{{ $item->deskripsi }}</p>
                </div>
                
                <!-- Additional Info Card -->
                <div class="mt-8 p-6 bg-gradient-to-r from-kai-blue/5 to-kai-orange/5 rounded-2xl border border-kai-blue/10">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full flex items-center justify-center mr-4">
                            <i class="fas fa-train text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="text-lg font-semibold text-kai-blue">Pencapaian Penting</h4>
                            <p class="text-gray-600">Tahun {{ $item->tahun }} menjadi tonggak sejarah penting dalam perkembangan KAI</p>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <!-- Default Timeline Content -->
        <div class="bg-white rounded-3xl shadow-2xl p-12 border border-gray-100">
            <div class="text-center text-gray-600">
                <div class="w-24 h-24 bg-gradient-to-r from-kai-blue to-kai-orange rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-history text-white text-3xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-kai-blue mb-4">Data Sejarah Belum Tersedia</h3>
                <p class="text-xl">Timeline sejarah KAI akan segera tersedia dengan informasi lengkap tentang perjalanan perusahaan.</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- Values Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-kai-orange/10 to-transparent rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-kai-blue/10 to-transparent rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider">Nilai-Nilai Kami</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-kai-blue mb-6">
                Fondasi Layanan Terbaik
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Prinsip-prinsip yang menjadi fondasi dalam setiap layanan yang kami berikan untuk kepuasan penumpang
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="group text-center p-10 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 border border-gray-100">
                <div class="relative mb-8">
                    <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-2xl w-24 h-24 flex items-center justify-center text-4xl mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="absolute -inset-2 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-2xl blur opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-3xl font-bold text-kai-blue mb-6 group-hover:text-kai-orange transition-colors duration-300">Aman</h3>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Keamanan penumpang dan keselamatan perjalanan menjadi prioritas utama dalam setiap layanan kami dengan standar internasional.
                </p>
            </div>
            
            <div class="group text-center p-10 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 border border-gray-100">
                <div class="relative mb-8">
                    <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white rounded-2xl w-24 h-24 flex items-center justify-center text-4xl mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-heart"></i>
                    </div>
                    <div class="absolute -inset-2 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-2xl blur opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-3xl font-bold text-kai-blue mb-6 group-hover:text-kai-orange transition-colors duration-300">Nyaman</h3>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Menyediakan pengalaman perjalanan yang nyaman dan menyenangkan untuk semua penumpang dengan fasilitas terbaik.
                </p>
            </div>
            
            <div class="group text-center p-10 bg-white rounded-3xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 border border-gray-100">
                <div class="relative mb-8">
                    <div class="bg-gradient-to-r from-green-500 to-green-600 text-white rounded-2xl w-24 h-24 flex items-center justify-center text-4xl mx-auto group-hover:scale-110 transition-transform duration-300 shadow-lg">
                        <i class="fas fa-handshake"></i>
                    </div>
                    <div class="absolute -inset-2 bg-gradient-to-r from-green-500 to-green-600 rounded-2xl blur opacity-0 group-hover:opacity-20 transition-opacity duration-300"></div>
                </div>
                <h3 class="text-3xl font-bold text-kai-blue mb-6 group-hover:text-kai-orange transition-colors duration-300">Terpercaya</h3>
                <p class="text-gray-600 text-lg leading-relaxed">
                    Membangun kepercayaan melalui layanan yang konsisten dan profesional di setiap perjalanan dengan komitmen tinggi.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Achievement Section -->
<section class="py-24 bg-gradient-to-br from-kai-blue via-kai-blue-light to-kai-blue relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M50 0L60 40H100L70 60L80 100L50 80L20 100L30 60L0 40H40Z"/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="container mx-auto px-4 text-center text-kai-white relative z-10" x-data="{ 
        stats: [
            { label: 'Tahun Berpengalaman', value: 0, target: 75, suffix: '+', icon: 'fas fa-calendar-alt', color: 'from-kai-orange to-kai-orange-light' },
            { label: 'Stasiun', value: 0, target: 420, suffix: '+', icon: 'fas fa-building', color: 'from-blue-400 to-blue-600' },
            { label: 'Rute Aktif', value: 0, target: 250, suffix: '+', icon: 'fas fa-subway', color: 'from-green-400 to-green-600' },
            { label: 'Penumpang Harian', value: 0, target: 500000, suffix: '+', icon: 'fas fa-users', color: 'from-purple-400 to-purple-600' }
        ],
        isVisible: false,
        init() {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        this.isVisible = true;
                        this.animateStats();
                    }
                });
            });
            observer.observe(this.$el);
        },
        animateStats() {
            this.stats.forEach((stat, index) => {
                setTimeout(() => {
                    let current = 0;
                    const increment = stat.target / 100;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= stat.target) {
                            stat.value = stat.target;
                            clearInterval(timer);
                        } else {
                            stat.value = Math.floor(current);
                        }
                    }, 15);
                }, index * 150);
            });
        }
    }">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-20">
                <h2 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                    Pencapaian 
                    <span class="bg-gradient-to-r from-kai-orange to-kai-orange-light bg-clip-text text-transparent">
                        KAI
                    </span>
                </h2>
                <div class="w-24 h-1 bg-gradient-to-r from-kai-orange to-kai-orange-light mx-auto mb-8"></div>
                <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up">
                    Angka-angka yang membuktikan kepercayaan masyarakat Indonesia terhadap layanan KAI
                </p>
            </div>
            
            <!-- Statistics Grid -->
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16">
                <template x-for="(stat, index) in stats" :key="stat.label">
                    <div class="group text-center">
                        <!-- Icon -->
                        <div class="relative mb-8">
                            <div class="w-24 h-24 mx-auto rounded-full bg-gradient-to-r flex items-center justify-center group-hover:scale-110 transition-transform duration-500 shadow-2xl" :class="stat.color">
                                <i :class="stat.icon" class="text-white text-3xl"></i>
                            </div>
                            <div class="absolute -inset-3 rounded-full bg-gradient-to-r opacity-0 group-hover:opacity-40 transition-opacity duration-500 blur-lg" :class="stat.color"></div>
                        </div>
                        
                        <!-- Number -->
                        <div class="mb-4">
                            <span class="text-6xl md:text-7xl font-bold bg-gradient-to-r bg-clip-text text-transparent leading-none" 
                                  :class="stat.color" 
                                  x-text="stat.label.includes('Penumpang') ? stat.value.toLocaleString() + stat.suffix : stat.value + stat.suffix">
                            </span>
                        </div>
                        
                        <!-- Label -->
                        <div class="text-gray-200 font-semibold text-lg md:text-xl leading-tight" x-text="stat.label"></div>
                        
                        <!-- Separator Line -->
                        <div class="mt-8 w-16 h-0.5 bg-gradient-to-r from-transparent via-white/30 to-transparent mx-auto"></div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-100 relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-kai-orange/10 to-transparent rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-kai-blue/10 to-transparent rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-4xl md:text-6xl font-bold text-kai-blue mb-6 animate-fade-in">
                Bergabunglah dengan 
                <span class="bg-gradient-to-r from-kai-orange to-kai-orange-light bg-clip-text text-transparent">
                    Kami
                </span>
            </h2>
            <p class="text-xl md:text-2xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed animate-slide-up">
                Mari menjadi bagian dari perjalanan sejarah PT Kereta Api Indonesia dan nikmati pengalaman perjalanan terbaik
            </p>
            
            <div class="flex flex-col sm:flex-row gap-6 justify-center animate-scale-in">
                <a href="{{ route('services') }}" class="group relative inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-kai-orange to-kai-orange-light hover:from-kai-orange-light hover:to-kai-orange text-white font-bold text-lg rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 shadow-2xl hover:shadow-3xl">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-train mr-3 text-xl group-hover:animate-bounce"></i>
                        Lihat Layanan Kami
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent rounded-full blur opacity-0 group-hover:opacity-100 transition duration-300"></div>
                </a>
                
                <a href="{{ route('contact') }}" class="group relative inline-flex items-center justify-center px-10 py-5 border-3 border-kai-blue text-kai-blue hover:bg-kai-blue hover:text-white font-bold text-lg rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 backdrop-blur-sm">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-envelope mr-3 text-xl group-hover:rotate-12 transition-transform duration-300"></i>
                        Hubungi Kami
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.shadow-3xl {
    box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25);
}

.border-3 {
    border-width: 3px;
}

/* Custom scrollbar */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: #f1f1f1;
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #eb6a28, #2c2a6b);
    border-radius: 4px;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #ff7c47, #3d3b7a);
}

/* Smooth page transitions */
.page-transition {
    opacity: 0;
    transform: translateY(20px);
    transition: opacity 0.5s ease, transform 0.5s ease;
}

.page-transition.loaded {
    opacity: 1;
    transform: translateY(0);
}
</style>
@endsection

