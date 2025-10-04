@extends('layouts.app')

@section('title', $news->judul . ' - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-96 flex items-center justify-center overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ $news->gambar ? asset('storage/' . $news->gambar) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80' }}');">
        <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
    </div>
    
    <div class="relative z-10 container mx-auto px-4 text-center text-kai-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    Berita KAI
                </span>
            </div>
            <h1 class="text-3xl md:text-5xl font-bold mb-6 animate-fade-in">
                {{ $news->judul }}
            </h1>
            <div class="flex items-center justify-center space-x-6 text-gray-200">
                <div class="flex items-center">
                    <i class="fas fa-user mr-2 text-kai-orange"></i>
                    <span>{{ $news->penulis }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-calendar mr-2 text-kai-orange"></i>
                    <span>{{ $news->tanggal ? (is_string($news->tanggal) ? date('d M Y', strtotime($news->tanggal)) : $news->tanggal->format('d M Y')) : 'N/A' }}</span>
                </div>
                <div class="flex items-center">
                    <i class="fas fa-clock mr-2 text-kai-orange"></i>
                    <span>{{ $news->tanggal ? (is_string($news->tanggal) ? \Carbon\Carbon::parse($news->tanggal)->diffForHumans() : $news->tanggal->diffForHumans()) : 'N/A' }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Content -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <!-- Breadcrumb -->
            <nav class="mb-8">
                <ol class="flex items-center space-x-2 text-sm text-gray-600">
                    <li><a href="{{ route('home') }}" class="hover:text-kai-blue transition-colors">Beranda</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                    <li><a href="{{ route('news') }}" class="hover:text-kai-blue transition-colors">Berita</a></li>
                    <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                    <li class="text-kai-blue font-semibold">{{ Str::limit($news->judul, 50) }}</li>
                </ol>
            </nav>

            <!-- Article Card -->
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Featured Image -->
                @if($news->gambar)
                <div class="h-96 overflow-hidden">
                    <img src="{{ asset('storage/' . $news->gambar) }}" alt="{{ $news->judul }}" class="w-full h-full object-cover">
                </div>
                @endif

                <!-- Article Content -->
                <div class="p-8 md:p-12">
                    <!-- Article Header -->
                    <header class="mb-8">
                        <h1 class="text-3xl md:text-4xl font-bold text-kai-blue mb-4">{{ $news->judul }}</h1>
                        
                        <!-- Meta Information -->
                        <div class="flex flex-wrap items-center gap-6 text-gray-600 border-b border-gray-200 pb-6">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-kai-blue rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Penulis</p>
                                    <p class="font-semibold text-kai-blue">{{ $news->penulis }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-kai-orange rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-calendar text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Tanggal Publikasi</p>
                                    <p class="font-semibold text-gray-800">{{ $news->tanggal ? (is_string($news->tanggal) ? date('d F Y', strtotime($news->tanggal)) : $news->tanggal->format('d F Y')) : 'N/A' }}</p>
                                </div>
                            </div>
                            
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-clock text-white"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Dipublikasikan</p>
                                    <p class="font-semibold text-gray-800">{{ $news->tanggal ? (is_string($news->tanggal) ? \Carbon\Carbon::parse($news->tanggal)->diffForHumans() : $news->tanggal->diffForHumans()) : 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </header>

                    <!-- Article Body -->
                    <div class="prose prose-lg max-w-none">
                        <div class="text-gray-700 leading-relaxed text-lg">
                            {!! nl2br(e($news->isi)) !!}
                        </div>
                    </div>

                    <!-- Share Section -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-kai-blue mb-4">Bagikan Artikel</h3>
                        <div class="flex space-x-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                               target="_blank" 
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-300 flex items-center">
                                <i class="fab fa-facebook-f mr-2"></i>
                                Facebook
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->judul) }}" 
                               target="_blank" 
                               class="bg-blue-400 text-white px-4 py-2 rounded-lg hover:bg-blue-500 transition-colors duration-300 flex items-center">
                                <i class="fab fa-twitter mr-2"></i>
                                Twitter
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($news->judul . ' - ' . request()->fullUrl()) }}" 
                               target="_blank" 
                               class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors duration-300 flex items-center">
                                <i class="fab fa-whatsapp mr-2"></i>
                                WhatsApp
                            </a>
                            <button onclick="copyToClipboard('{{ request()->fullUrl() }}')" 
                                    class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors duration-300 flex items-center">
                                <i class="fas fa-link mr-2"></i>
                                Copy Link
                            </button>
                        </div>
                    </div>
                </div>
            </article>
        </div>
    </div>
</section>

<!-- Related News Section -->
@if($relatedNews && $relatedNews->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-bold text-kai-blue mb-4">Berita Terkait</h2>
                <p class="text-gray-600 text-lg">Artikel lainnya yang mungkin menarik untuk Anda</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($relatedNews as $related)
                <article class="group bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:scale-105">
                    <!-- Image -->
                    <div class="h-48 overflow-hidden">
                        @if($related->gambar)
                            <img src="{{ asset('storage/' . $related->gambar) }}" alt="{{ $related->judul }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="h-full bg-gradient-to-br from-kai-blue to-kai-orange flex items-center justify-center">
                                <img src="{{ asset('logo.png') }}" alt="KAI" class="w-16 h-16 object-contain">
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Meta -->
                        <div class="flex items-center text-sm text-gray-500 mb-3">
                            <i class="fas fa-calendar mr-2 text-kai-orange"></i>
                            <span>{{ $related->tanggal ? (is_string($related->tanggal) ? date('d M Y', strtotime($related->tanggal)) : $related->tanggal->format('d M Y')) : 'N/A' }}</span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-lg font-bold text-kai-blue mb-3 group-hover:text-kai-orange transition-colors duration-300">
                            <a href="{{ route('news.show', $related->id) }}">{{ Str::limit($related->judul, 60) }}</a>
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-gray-600 text-sm leading-relaxed mb-4">
                            {{ Str::limit(strip_tags($related->isi), 100) }}
                        </p>

                        <!-- Read More -->
                        <a href="{{ route('news.show', $related->id) }}" 
                           class="inline-flex items-center text-kai-orange font-semibold hover:text-kai-blue transition-colors duration-300">
                            Baca Selengkapnya
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- View All News Button -->
            <div class="text-center mt-12">
                <a href="{{ route('news') }}" 
                   class="inline-flex items-center bg-kai-blue text-white px-8 py-3 rounded-xl font-semibold hover:bg-kai-blue-light transition-all duration-300 transform hover:scale-105">
                    <i class="fas fa-newspaper mr-2"></i>
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Back to Top Button -->
<button id="backToTop" 
        class="fixed bottom-8 right-8 bg-kai-orange text-white w-12 h-12 rounded-full shadow-lg hover:bg-kai-orange-light transition-all duration-300 transform hover:scale-110 opacity-0 invisible"
        onclick="window.scrollTo({ top: 0, behavior: 'smooth' })">
    <i class="fas fa-arrow-up"></i>
</button>

<script>
// Copy to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalText = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check mr-2"></i>Copied!';
        button.classList.add('bg-green-500');
        button.classList.remove('bg-gray-600');
        
        setTimeout(() => {
            button.innerHTML = originalText;
            button.classList.remove('bg-green-500');
            button.classList.add('bg-gray-600');
        }, 2000);
    });
}

// Back to top button functionality
window.addEventListener('scroll', function() {
    const backToTop = document.getElementById('backToTop');
    if (window.pageYOffset > 300) {
        backToTop.classList.remove('opacity-0', 'invisible');
        backToTop.classList.add('opacity-100', 'visible');
    } else {
        backToTop.classList.add('opacity-0', 'invisible');
        backToTop.classList.remove('opacity-100', 'visible');
    }
});
</script>
@endsection
