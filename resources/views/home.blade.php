@extends('layouts.app')

@section('title', 'Beranda - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen overflow-hidden" x-data="{ 
    currentSlide: 0,
    slides: [
        { bg: '{{ asset('assets/kereta-background.jpg') }}', title: '{{ $profile->nama_perusahaan ?? 'PT Kereta Api Indonesia' }}', subtitle: '{{ $profile->slogan ?? 'Menghubungkan Nusantara dengan Layanan Transportasi Terbaik' }}' },
        { bg: 'https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80', title: 'Layanan Terbaik', subtitle: 'Nikmati perjalanan yang aman, nyaman, dan terpercaya' },
        { bg: '{{ asset('assets/kai-background-1.jpg') }}', title: 'Teknologi Modern', subtitle: 'Menggunakan teknologi terdepan untuk kenyamanan Anda' }
    ],
    init() {
        setInterval(() => {
            this.currentSlide = (this.currentSlide + 1) % this.slides.length;
        }, 6000);
    }
}">
    <!-- Background Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div class="absolute inset-0 transition-opacity duration-1000 ease-in-out"
             :class="currentSlide === index ? 'opacity-100' : 'opacity-0'"
             :style="`background-image: url('${slide.bg}'); background-size: cover; background-position: center;`">
            <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
        </div>
    </template>
    
    
    <!-- Hero Content -->
    <div class="relative z-10 h-full flex items-center" x-data="{ 
        contentVisible: false,
        init() {
            setTimeout(() => {
                this.contentVisible = true;
            }, 500);
        }
    }">
        <div class="container mx-auto px-4 text-center text-kai-white">
            <!-- Logo KAI -->
            <div class="mb-8 flex justify-center">
                <div class="relative">
                    <img src="{{ asset('logo-background-2.png') }}" alt="KAI Logo" class="w-32 h-32 sm:w-48 sm:h-48 md:w-72 md:h-72 lg:w-96 lg:h-96 object-contain transition-all duration-1200 ease-out"
                         x-show="contentVisible"
                         x-transition:enter="transition ease-out duration-1200"
                         x-transition:enter-start="opacity-0 transform scale-75"
                         x-transition:enter-end="opacity-100 transform scale-100">
                    <div class="absolute -inset-2 bg-gradient-to-r from-kai-white/20 to-kai-white-light/20 rounded-full blur opacity-0 hover:opacity-100 transition-opacity duration-300"></div>
                </div>
            </div>
            
            <!-- Main Title with Fade Animation -->
            <div class="mb-6">
                <h1 class="text-5xl md:text-7xl font-bold mb-4 transition-all duration-1200 ease-out" 
                    x-text="slides[currentSlide].title"
                    x-show="contentVisible"
                    x-transition:enter="transition ease-out duration-1200"
                    x-transition:enter-start="opacity-0 transform translate-y-8"
                    x-transition:enter-end="opacity-100 transform translate-y-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-y-0"
                    x-transition:leave-end="opacity-0 transform translate-y-8">
                </h1>
            </div>
            
            <!-- Subtitle with Fade Animation -->
            <div class="mb-8">
                <p class="text-xl md:text-2xl text-gray-200 transition-all duration-1200 ease-out" 
                   x-text="slides[currentSlide].subtitle"
                   x-show="contentVisible"
                   x-transition:enter="transition ease-out duration-1200"
                   x-transition:enter-start="opacity-0 transform translate-y-6"
                   x-transition:enter-end="opacity-100 transform translate-y-0"
                   x-transition:leave="transition ease-in duration-300"
                   x-transition:leave-start="opacity-100 transform translate-y-0"
                   x-transition:leave-end="opacity-0 transform translate-y-6">
                </p>
            </div>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center">
                <a href="{{ route('services') }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-kai-orange hover:bg-kai-orange-light text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl"
                   x-show="contentVisible"
                   x-transition:enter="transition ease-out duration-1200"
                   x-transition:enter-start="opacity-0 transform translate-y-8 scale-90"
                   x-transition:enter-end="opacity-100 transform translate-y-0 scale-100">
                    <span class="relative z-10 flex items-center">
                        <img src="{{ asset('logo-background-2.png') }}" alt="KAI" class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform duration-300 object-contain">
                        Lihat Layanan
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                </a>
                <a href="{{ route('about') }}" class="group relative inline-flex items-center justify-center px-8 py-4 border-2 border-white text-white hover:bg-white hover:text-kai-blue font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 backdrop-blur-sm"
                   x-show="contentVisible"
                   x-transition:enter="transition ease-out duration-1200"
                   x-transition:enter-start="opacity-0 transform translate-y-8 scale-90"
                   x-transition:enter-end="opacity-100 transform translate-y-0 scale-100">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-info-circle mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                        Pelajari Lebih Lanjut
                    </span>
                </a>
            </div>
        </div>
    </div>
    
    <!-- Slide Indicators -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 flex space-x-3">
        <template x-for="(slide, index) in slides" :key="index">
            <button @click="currentSlide = index" 
                    class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="currentSlide === index ? 'bg-kai-orange scale-125' : 'bg-white/50 hover:bg-white/75'">
            </button>
        </template>
    </div>
</section>

<!-- Statistics Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-100 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="100" height="100" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%232c2a6b" fill-opacity="0.1"%3E%3Cpath d="M50 0L60 40H100L70 60L80 100L50 80L20 100L30 60L0 40H40Z"/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10" x-data="{ 
        stats: [
            { label: 'Penumpang Harian', value: 0, target: 500000, suffix: '+', icon: 'fas fa-users', color: 'from-blue-500 to-blue-600' },
            { label: 'Rute Aktif', value: 0, target: 250, suffix: '+', icon: 'fas fa-subway', color: 'from-kai-orange to-orange-600' },
            { label: 'Stasiun', value: 0, target: 420, suffix: '+', icon: 'fas fa-building', color: 'from-green-500 to-green-600' },
            { label: 'Tahun Berpengalaman', value: 0, target: 75, suffix: '+', icon: 'fas fa-calendar-alt', color: 'from-purple-500 to-purple-600' }
        ],
        isVisible: false,
        init() {
            // Intersection Observer untuk animasi saat scroll
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
                    }, 20);
                }, index * 300);
            });
        }
    }">
        <div class="text-center mb-16">
            <h2 class="text-4xl md:text-5xl font-bold text-kai-blue mb-6 animate-fade-in">
                Pencapaian KAI
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto animate-slide-up">
                Angka-angka yang membuktikan kepercayaan masyarakat Indonesia terhadap layanan KAI
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <template x-for="(stat, index) in stats" :key="stat.label">
                <div class="group relative">
                    <div class="text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 border border-gray-100">
                            <!-- Icon Container -->
                            <div class="relative mb-6">
                                <div class="w-20 h-20 mx-auto rounded-full bg-gradient-to-r flex items-center justify-center group-hover:scale-110 transition-transform duration-300" :class="stat.color">
                                    <i :class="stat.icon" class="text-white text-2xl"></i>
                                </div>
                                <div class="absolute -inset-2 rounded-full bg-gradient-to-r opacity-0 group-hover:opacity-20 transition-opacity duration-300 blur" :class="stat.color"></div>
                            </div>
                        
                        <!-- Number -->
                        <div class="mb-3">
                            <span class="text-4xl md:text-5xl font-bold bg-gradient-to-r bg-clip-text text-transparent" 
                                  :class="stat.color" 
                                  x-text="stat.value.toLocaleString() + stat.suffix">
                            </span>
                        </div>
                        
                        <!-- Label -->
                        <div class="text-gray-600 font-medium text-lg" x-text="stat.label"></div>
                    </div>
                </div>
            </template>
        </div>
    </div>
</section>

<!-- About Preview Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-br from-kai-orange/10 to-transparent rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-gradient-to-tr from-kai-blue/10 to-transparent rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider">Tentang Kami</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-kai-blue mb-6">
                Perjalanan Panjang KAI
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                {{ $profile->visi ?? 'Menjadi perusahaan transportasi kereta api yang unggul dan terpercaya di Indonesia dengan standar internasional' }}
            </p>
        </div>
        
        @if($aboutItems && $aboutItems->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @foreach($aboutItems as $index => $item)
            <div class="group relative" x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 border border-gray-100 h-full">
                    <!-- Year Badge -->
                    <div class="relative mb-6">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full text-white text-2xl font-bold shadow-lg group-hover:scale-110 transition-transform duration-300">
                            {{ $item->tahun }}
                        </div>
                        <div class="absolute -inset-2 rounded-full bg-gradient-to-r from-kai-orange to-kai-orange-light opacity-0 group-hover:opacity-20 transition-opacity duration-300 blur"></div>
                    </div>
                    
                    <!-- Title -->
                    <h3 class="text-xl font-bold text-kai-blue mb-4 group-hover:text-kai-orange transition-colors duration-300">
                        {{ $item->judul }}
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 leading-relaxed">
                        {{ Str::limit($item->deskripsi, 150) }}
                    </p>
                    
                    <!-- Read More -->
                    <div class="mt-6 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('about') }}" class="inline-flex items-center text-kai-orange font-semibold hover:text-kai-orange-light transition-colors duration-300">
                            <span>Baca Selengkapnya</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- CTA Section -->
        <div class="text-center">
            <div class="inline-flex flex-col sm:flex-row gap-4">
                <a href="{{ route('about') }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-kai-blue to-kai-blue-light hover:from-kai-blue-light hover:to-kai-blue text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-history mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                        Lihat Sejarah Lengkap
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-30 transition duration-300"></div>
                </a>
                    <a href="{{ route('services') }}" class="group relative inline-flex items-center justify-center px-8 py-4 border-2 border-kai-orange text-kai-orange hover:bg-kai-orange hover:text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                        <span class="relative z-10 flex items-center">
                            <img src="{{ asset('logo.png') }}" alt="KAI" class="w-6 h-6 mr-3 group-hover:scale-110 transition-transform duration-300 object-contain">
                            Lihat Layanan
                        </span>
                    </a>
            </div>
        </div>
    </div>
</section>

<!-- Services Preview Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 via-white to-gray-100 relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-5">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="80" height="80" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23eb6a28" fill-opacity="0.1"%3E%3Cpath d="M40 0L50 30H80L60 50L70 80L40 60L10 80L20 50L0 30H30Z"/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider">Layanan Unggulan</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-kai-blue mb-6">
                Solusi Transportasi Terbaik
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Berbagai layanan transportasi kereta api yang memenuhi kebutuhan perjalanan Anda dengan standar internasional
            </p>
        </div>
        
        @if($services && $services->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($services->take(6) as $index => $service)
            <div class="group relative" x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 border border-gray-100 h-full">
                        <!-- Icon Container -->
                        <div class="relative mb-6">
                            <div class="w-16 h-16 bg-gradient-to-r from-kai-white to-kai-white rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-lg">
                                <img src="{{ asset('logo.png') }}" alt="KAI" class="w-10 h-10 object-contain">
                            </div>
                            <div class="absolute -inset-2 rounded-2xl bg-gradient-to-r from-kai-orange to-kai-orange-light opacity-0 group-hover:opacity-20 transition-opacity duration-300 blur"></div>
                        </div>
                    
                    <!-- Title -->
                    <h3 class="text-xl font-bold text-kai-blue mb-4 group-hover:text-kai-orange transition-colors duration-300">
                        {{ $service->nama_layanan }}
                    </h3>
                    
                    <!-- Description -->
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ Str::limit($service->deskripsi, 120) }}
                    </p>
                    
                    <!-- Learn More Button -->
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('services') }}" class="inline-flex items-center text-kai-orange font-semibold hover:text-kai-orange-light transition-colors duration-300">
                            <span>Pelajari Lebih Lanjut</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
        
        <!-- CTA Section -->
        <div class="text-center">
            <div class="inline-flex flex-col sm:flex-row gap-4">
                <a href="{{ route('services') }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-kai-orange to-kai-orange-light hover:from-kai-orange-light hover:to-kai-orange text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-list mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                        Lihat Semua Layanan
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-full blur opacity-0 group-hover:opacity-30 transition duration-300"></div>
                </a>
                <a href="{{ route('contact') }}" class="group relative inline-flex items-center justify-center px-8 py-4 border-2 border-kai-blue text-kai-blue hover:bg-kai-blue hover:text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-phone mr-3 group-hover:animate-pulse"></i>
                        Hubungi Kami
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<section class="py-20 bg-white relative overflow-hidden">
    <!-- Background Elements -->
    <div class="absolute top-1/4 right-0 w-96 h-96 bg-gradient-to-l from-kai-blue/10 to-transparent rounded-full blur-3xl"></div>
    <div class="absolute bottom-1/4 left-0 w-96 h-96 bg-gradient-to-r from-kai-orange/10 to-transparent rounded-full blur-3xl"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider">Berita Terkini</span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-kai-blue mb-6">
                Informasi Terbaru KAI
            </h2>
            <p class="text-xl text-gray-600 max-w-4xl mx-auto leading-relaxed">
                Dapatkan informasi terkini seputar PT Kereta Api Indonesia, layanan terbaru, dan perkembangan teknologi
            </p>
        </div>
        
        @if($latestNews && $latestNews->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @foreach($latestNews as $index => $news)
            <article class="group relative" x-data="{ isHovered: false }" @mouseenter="isHovered = true" @mouseleave="isHovered = false">
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:scale-105 hover:-translate-y-2 border border-gray-100">
                    <!-- Image Container -->
                    <div class="relative h-56 overflow-hidden">
                        @if($news->gambar)
                            <img src="{{ asset('storage/' . $news->gambar) }}" alt="{{ $news->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="h-full bg-gradient-to-br from-kai-blue to-kai-orange flex items-center justify-center">
                                    <img src="{{ asset('logo.png') }}" alt="KAI" class="w-16 h-16 object-contain group-hover:scale-110 transition-transform duration-300">
                                </div>
                            @endif
                        
                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Date Badge -->
                        <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 text-sm font-semibold text-kai-blue">
                            {{ $news->tanggal ? (is_string($news->tanggal) ? date('d M Y', strtotime($news->tanggal)) : $news->tanggal->format('d M Y')) : 'N/A' }}
                        </div>
                        
                        <!-- Read More Button (on hover) -->
                        <div class="absolute bottom-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <a href="{{ route('news.show', $news->id) }}" class="bg-kai-orange text-white px-4 py-2 rounded-full text-sm font-semibold hover:bg-kai-orange-light transition-colors duration-300">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                    
                    <!-- Content -->
                    <div class="p-6">
                        <!-- Meta Info -->
                        <div class="flex items-center text-sm text-gray-500 mb-4">
                            <div class="flex items-center mr-4">
                                <i class="fas fa-user mr-2 text-kai-orange"></i>
                                <span>{{ $news->penulis }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-clock mr-2 text-kai-orange"></i>
                                <span>{{ $news->tanggal ? (is_string($news->tanggal) ? \Carbon\Carbon::parse($news->tanggal)->diffForHumans() : $news->tanggal->diffForHumans()) : 'N/A' }}</span>
                            </div>
                        </div>
                        
                        <!-- Title -->
                        <h3 class="text-xl font-bold text-kai-blue mb-3 group-hover:text-kai-orange transition-colors duration-300 line-clamp-2">
                            {{ $news->judul }}
                        </h3>
                        
                        <!-- Excerpt -->
                        <p class="text-gray-600 leading-relaxed mb-4 line-clamp-3">
                            {{ Str::limit(strip_tags($news->isi), 120) }}
                        </p>
                        
                        <!-- Read More Link -->
                        <a href="{{ route('news.show', $news->id) }}" class="inline-flex items-center text-kai-orange font-semibold hover:text-kai-orange-light transition-colors duration-300">
                            <span>Baca Selengkapnya</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @endif
        
        <!-- CTA Section -->
        <div class="text-center">
            <div class="inline-flex flex-col sm:flex-row gap-4">
                <a href="{{ route('news') }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-kai-blue to-kai-blue-light hover:from-kai-blue-light hover:to-kai-blue text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-newspaper mr-3 group-hover:rotate-12 transition-transform duration-300"></i>
                        Lihat Semua Berita
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-30 transition duration-300"></div>
                </a>
                <a href="{{ route('contact') }}" class="group relative inline-flex items-center justify-center px-8 py-4 border-2 border-kai-orange text-kai-orange hover:bg-kai-orange hover:text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-bell mr-3 group-hover:animate-pulse"></i>
                        Berlangganan Newsletter
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 mb-20 bg-gradient-to-br from-kai-blue via-kai-blue-light to-kai-blue relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="120" height="120" viewBox="0 0 120 120" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M60 0L72 48H120L84 72L96 120L60 96L24 120L36 72L0 48H48Z"/%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>
    
    
    <div class="container mx-auto px-4 text-center relative z-10">
        <div class="max-w-4xl mx-auto">
            <!-- Main Heading -->
            <h2 class="text-4xl md:text-6xl font-bold text-white mb-6 animate-fade-in">
                Siap Memulai 
                <span class="bg-gradient-to-r from-kai-orange to-kai-orange-light bg-clip-text text-transparent">
                    Perjalanan?
                </span>
            </h2>
            
            <!-- Subtitle -->
            <p class="text-xl md:text-2xl text-gray-200 mb-12 max-w-3xl mx-auto leading-relaxed animate-slide-up">
                Nikmati pengalaman perjalanan yang aman, nyaman, dan terpercaya bersama PT Kereta Api Indonesia
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-6 justify-center animate-scale-in">
                     <a href="{{ route('services') }}" class="group relative inline-flex items-center justify-center px-10 py-5 bg-gradient-to-r from-kai-orange to-kai-orange-light hover:from-kai-orange-light hover:to-kai-orange text-white font-bold text-lg rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 shadow-2xl hover:shadow-3xl">
                         <span class="relative z-10 flex items-center">
                             <img src="{{ asset('logo-background-2.png') }}" alt="KAI" class="w-8 h-8 mr-3 group-hover:scale-110 transition-transform duration-300 object-contain">
                             Pesan Tiket Sekarang
                         </span>
                         <div class="absolute inset-0 bg-gradient-to-r from-white/20 to-transparent rounded-full blur opacity-0 group-hover:opacity-100 transition duration-300"></div>
                     </a>
                
                <a href="{{ route('contact') }}" class="group relative inline-flex items-center justify-center px-10 py-5 border-3 border-white text-white hover:bg-white hover:text-kai-blue font-bold text-lg rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 backdrop-blur-sm">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-phone mr-3 text-xl group-hover:rotate-12 transition-transform duration-300"></i>
                        Hubungi Customer Service
                    </span>
                </a>
            </div>
            
            <!-- Additional Info -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-white">
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-shield-alt text-2xl text-kai-orange"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">100% Aman</h3>
                    <p class="text-gray-300 text-sm">Keamanan penumpang adalah prioritas utama</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-clock text-2xl text-kai-orange"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Tepat Waktu</h3>
                    <p class="text-gray-300 text-sm">Komitmen tinggi terhadap jadwal keberangkatan</p>
                </div>
                
                <div class="text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-heart text-2xl text-kai-orange"></i>
                    </div>
                    <h3 class="text-lg font-semibold mb-2">Pelayanan Terbaik</h3>
                    <p class="text-gray-300 text-sm">Kenyamanan dan kepuasan penumpang</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

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
