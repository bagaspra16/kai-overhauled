@extends('layouts.app')

@section('title', 'Berita - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Slideshow -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000" 
         style="background-image: url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
    </div>
    
    
    <div class="relative z-10 container mx-auto px-4 text-center text-kai-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    Berita & Informasi
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Akses Berita Terkini
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up">
            Informasi terkini seputar PT Kereta Api Indonesia, layanan, dan perkembangan terbaru
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

<!-- News Grid Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        @if($news && $news->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
            @foreach($news as $article)
            <article class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300 group" x-data="{ showModal: false }">
                <!-- News Image -->
                <div class="h-48 bg-cover bg-center relative overflow-hidden">
                    @if($article->gambar)
                        <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                        <div class="h-full bg-gradient-to-r from-kai-blue to-kai-orange flex items-center justify-center">
                            <i class="fas fa-newspaper text-white text-4xl"></i>
                        </div>
                    @endif
                    <div class="absolute top-4 left-4 bg-kai-orange text-white px-3 py-1 rounded-full text-sm font-semibold">
                        {{ $article->tanggal->format('d M Y') }}
                    </div>
                </div>
                
                <!-- News Content -->
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <i class="fas fa-user mr-2"></i>
                        <span>{{ $article->penulis }}</span>
                        <span class="mx-2">•</span>
                        <i class="fas fa-calendar mr-2"></i>
                        <span>{{ $article->tanggal->format('d M Y') }}</span>
                    </div>
                    
                    <h3 class="text-xl font-semibold text-kai-blue mb-3 group-hover:text-kai-orange transition-colors duration-300">
                        {{ $article->judul }}
                    </h3>
                    
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($article->isi), 120) }}
                    </p>
                    
                    <div class="flex items-center justify-between">
                        <button @click="showModal = true" class="text-kai-orange hover:text-orange-600 font-semibold transition-colors duration-300">
                            Baca Selengkapnya <i class="fas fa-arrow-right ml-1"></i>
                        </button>
                        
                        <div class="flex space-x-2">
                            <button class="text-gray-400 hover:text-kai-orange transition-colors duration-300">
                                <i class="fas fa-share-alt"></i>
                            </button>
                            <button class="text-gray-400 hover:text-kai-orange transition-colors duration-300">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Modal -->
                <div x-show="showModal" x-transition class="fixed inset-0 z-50 overflow-y-auto" style="display: none;">
                    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" @click="showModal = false"></div>
                        
                        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-4xl sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-2xl font-bold text-kai-blue">{{ $article->judul }}</h3>
                                    <button @click="showModal = false" class="text-gray-400 hover:text-gray-600">
                                        <i class="fas fa-times text-xl"></i>
                                    </button>
                                </div>
                                
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>{{ $article->penulis }}</span>
                                    <span class="mx-2">•</span>
                                    <i class="fas fa-calendar mr-2"></i>
                                    <span>{{ $article->tanggal->format('d M Y, H:i') }}</span>
                                </div>
                                
                                @if($article->gambar)
                                <div class="mb-6">
                                    <img src="{{ asset('storage/' . $article->gambar) }}" alt="{{ $article->judul }}" class="w-full h-64 object-cover rounded-lg">
                                </div>
                                @endif
                                
                                <div class="prose max-w-none">
                                    {!! nl2br(e($article->isi)) !!}
                                </div>
                            </div>
                            
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button @click="showModal = false" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-kai-blue text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    Tutup
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($news->hasPages())
        <div class="flex justify-center">
            {{ $news->links() }}
        </div>
        @endif
        @else
        <!-- No News Available -->
        <div class="text-center py-16">
            <div class="bg-white rounded-lg shadow-lg p-12 max-w-md mx-auto">
                <i class="fas fa-newspaper text-6xl text-gray-300 mb-6"></i>
                <h3 class="text-2xl font-semibold text-gray-600 mb-4">Belum Ada Berita</h3>
                <p class="text-gray-500">Berita terbaru akan segera tersedia.</p>
            </div>
        </div>
        @endif
    </div>
</section>

<!-- News Categories Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-kai-blue mb-4">Kategori Berita</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Temukan berita sesuai kategori yang Anda minati
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                <div class="bg-kai-blue text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-train"></i>
                </div>
                <h3 class="text-lg font-semibold text-kai-blue mb-2">Layanan</h3>
                <p class="text-gray-600 text-sm">Informasi layanan terbaru</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                <div class="bg-kai-orange text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-calendar-alt"></i>
                </div>
                <h3 class="text-lg font-semibold text-kai-blue mb-2">Jadwal</h3>
                <p class="text-gray-600 text-sm">Perubahan jadwal kereta</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                <div class="bg-green-500 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-newspaper"></i>
                </div>
                <h3 class="text-lg font-semibold text-kai-blue mb-2">Pengumuman</h3>
                <p class="text-gray-600 text-sm">Pengumuman resmi KAI</p>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6 text-center hover:shadow-xl transition-shadow duration-300 group cursor-pointer">
                <div class="bg-purple-500 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-4 group-hover:scale-110 transition-transform duration-300">
                    <i class="fas fa-star"></i>
                </div>
                <h3 class="text-lg font-semibold text-kai-blue mb-2">Pencapaian</h3>
                <p class="text-gray-600 text-sm">Prestasi dan penghargaan</p>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Subscription Section -->
<section class="py-16 bg-gradient-to-r from-kai-blue to-blue-800">
    <div class="container mx-auto px-4 text-center text-kai-white">
        <h2 class="text-4xl font-bold mb-6">Berlangganan Newsletter</h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Dapatkan informasi terbaru tentang layanan, jadwal, dan promosi KAI langsung di email Anda
        </p>
        
        <div class="max-w-md mx-auto" x-data="{ email: '', subscribed: false }">
            <div x-show="!subscribed" class="flex flex-col sm:flex-row gap-4">
                <input type="email" x-model="email" placeholder="Masukkan email Anda" 
                       class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-kai-orange">
                <button @click="subscribed = true" 
                        class="bg-kai-orange hover:bg-orange-600 text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-300">
                    <i class="fas fa-envelope mr-2"></i>
                    Berlangganan
                </button>
            </div>
            <div x-show="subscribed" x-transition class="bg-green-500 text-white p-4 rounded-lg">
                <i class="fas fa-check-circle mr-2"></i>
                Terima kasih! Anda telah berlangganan newsletter kami.
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-kai-blue mb-4">Butuh Informasi Lebih Lanjut?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Hubungi kami untuk informasi terbaru tentang layanan dan jadwal KAI
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="bg-kai-blue text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fas fa-phone"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-2">Customer Service</h3>
                <p class="text-gray-600 mb-4">24 Jam Non-Stop</p>
                <a href="tel:1500000" class="text-kai-orange font-semibold hover:text-orange-600 transition-colors duration-300">
                    1500000
                </a>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="bg-kai-orange text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fas fa-envelope"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-2">Email</h3>
                <p class="text-gray-600 mb-4">Responsif & Cepat</p>
                <a href="mailto:info@kai.id" class="text-kai-orange font-semibold hover:text-orange-600 transition-colors duration-300">
                    info@kai.id
                </a>
            </div>
            
            <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                <div class="bg-green-500 text-white rounded-full w-16 h-16 flex items-center justify-center text-2xl mx-auto mb-4">
                    <i class="fab fa-whatsapp"></i>
                </div>
                <h3 class="text-xl font-semibold text-kai-blue mb-2">WhatsApp</h3>
                <p class="text-gray-600 mb-4">Chat Langsung</p>
                <a href="https://wa.me/628111500000" class="text-kai-orange font-semibold hover:text-orange-600 transition-colors duration-300">
                    +62 811-1500-000
                </a>
            </div>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection

