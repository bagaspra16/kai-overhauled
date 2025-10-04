@extends('admin.layouts.app')

@section('title', 'Dasbor')

@section('content')
<!-- Page Header with Welcome Message and Time -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-8">
    <div class="flex-1">
        <div class="flex items-center mb-2">
            <div class="w-12 h-12 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-full flex items-center justify-center mr-4">
                <i class="fas fa-tachometer-alt text-white text-xl"></i>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-900">
                    Selamat {{ $greeting ?? 'datang' }}, {{ auth()->user()->name ?? 'Admin' }}!
                </h1>
                <p class="text-gray-600 mt-1">Berikut ringkasan aktivitas sistem KAI hari ini</p>
            </div>
        </div>
    </div>
    
    <!-- Real-time Clock and Weather -->
    <div class="flex items-center space-x-4 mt-4 lg:mt-0">
        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-100">
            <div class="flex items-center space-x-3">
                <div class="text-center">
                    <div id="current-time" class="text-2xl font-bold text-kai-blue">--:--</div>
                    <div id="current-date" class="text-sm text-gray-600">Loading...</div>
                </div>
                <div class="w-px h-12 bg-gray-200"></div>
                <div class="text-center">
                    <div class="text-lg font-semibold text-kai-orange">Jakarta</div>
                    <div class="text-sm text-gray-600">WIB</div>
                </div>
            </div>
        </div>
        
        <!-- System Status Indicator -->
        <div class="bg-white rounded-xl shadow-lg p-4 border border-gray-100">
            <div class="flex items-center space-x-2">
                <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                <span class="text-sm font-medium text-gray-700">Sistem Online</span>
            </div>
            <div class="text-xs text-gray-500 mt-1">Uptime: 99.9%</div>
        </div>
    </div>
</div>

<!-- Main Statistics Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Stations Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-blue hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Stasiun</p>
                <p class="text-3xl font-bold text-kai-blue counter" data-target="{{ $stats['stations_count'] ?? 0 }}">0</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-green-600 text-sm">Aktif</span>
                </div>
            </div>
            <div class="bg-kai-blue/10 p-3 rounded-full">
                <i class="fas fa-map-marker-alt text-kai-blue text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Routes Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-orange hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Rute</p>
                <p class="text-3xl font-bold text-kai-orange counter" data-target="{{ $stats['routes_count'] ?? 0 }}">0</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-green-600 text-sm">Operasional</span>
                </div>
            </div>
            <div class="bg-kai-orange/10 p-3 rounded-full">
                <i class="fas fa-route text-kai-orange text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Schedules Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Jadwal</p>
                <p class="text-3xl font-bold text-green-600 counter" data-target="{{ $stats['schedules_count'] ?? 0 }}">0</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-green-600 text-sm">Tersedia</span>
                </div>
            </div>
            <div class="bg-green-500/10 p-3 rounded-full">
                <i class="fas fa-calendar-alt text-green-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- News Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Artikel Berita</p>
                <p class="text-3xl font-bold text-purple-600 counter" data-target="{{ $stats['news_count'] ?? 0 }}">0</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-green-600 text-sm">Diterbitkan</span>
                </div>
            </div>
            <div class="bg-purple-500/10 p-3 rounded-full">
                <i class="fas fa-newspaper text-purple-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Additional Data Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Services Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-teal-500 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Layanan</p>
                <p class="text-3xl font-bold text-teal-600">{{ $stats['services_count'] ?? 0 }}</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-green-600 text-sm">Tersedia</span>
                </div>
            </div>
            <div class="bg-teal-500/10 p-3 rounded-full">
                <i class="fas fa-cogs text-teal-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- About Entries Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-indigo-500 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Entri Tentang</p>
                <p class="text-3xl font-bold text-indigo-600">{{ $stats['about_count'] ?? 0 }}</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-green-600 text-sm">Aktif</span>
                </div>
            </div>
            <div class="bg-indigo-500/10 p-3 rounded-full">
                <i class="fas fa-info-circle text-indigo-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- Profiles Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-pink-500 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Profil</p>
                <p class="text-3xl font-bold text-pink-600">{{ $stats['profiles_count'] ?? 0 }}</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full mr-2"></div>
                    <span class="text-green-600 text-sm">Terdaftar</span>
                </div>
            </div>
            <div class="bg-pink-500/10 p-3 rounded-full">
                <i class="fas fa-users text-pink-600 text-2xl"></i>
            </div>
        </div>
    </div>

    <!-- System Status Card -->
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-emerald-500 hover:shadow-xl transition-all duration-300">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Status Sistem</p>
                <p class="text-2xl font-bold text-emerald-600">Online</p>
                <div class="flex items-center mt-2">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></div>
                    <span class="text-green-600 text-sm">Berjalan Normal</span>
                </div>
            </div>
            <div class="bg-emerald-500/10 p-3 rounded-full">
                <i class="fas fa-server text-emerald-600 text-2xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content Grid -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
    <!-- Recent News -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-newspaper mr-3"></i>
                Berita Terbaru
            </h3>
        </div>
        <div class="p-6">
            @if(isset($recentNews) && $recentNews->count() > 0)
                <div class="space-y-4">
                    @foreach($recentNews->take(4) as $news)
                    <div class="flex items-start space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                        @if($news->gambar)
                            <img src="{{ asset('storage/' . $news->gambar) }}" 
                                 alt="{{ $news->judul }}" 
                                 class="w-16 h-16 object-cover rounded-lg flex-shrink-0">
                        @else
                            <div class="w-16 h-16 bg-kai-blue/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-newspaper text-kai-blue text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 truncate">{{ $news->judul }}</h4>
                            <p class="text-sm text-gray-600 mt-1">{{ Str::limit($news->isi, 100) }}</p>
                            <div class="flex items-center mt-2 text-xs text-gray-500">
                                <i class="fas fa-user mr-1"></i>
                                <span class="mr-3">{{ $news->penulis }}</span>
                                <i class="fas fa-calendar mr-1"></i>
                                <span>{{ $news->tanggal->format('M d, Y') }}</span>
                            </div>
                        </div>
                        <a href="{{ route('admin.news.show', $news->id) }}" 
                           class="text-kai-blue hover:text-kai-orange transition-colors duration-300">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-newspaper text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Belum ada artikel berita.</p>
                    <a href="{{ route('admin.news.create') }}" 
                       class="inline-flex items-center mt-4 px-4 py-2 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Artikel Pertama
                    </a>
                </div>
            @endif
            <div class="mt-6 text-center">
                <a href="{{ route('admin.news.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <span>Lihat Semua Berita</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Schedules -->
    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
        <div class="bg-gradient-to-r from-green-500 to-emerald-600 text-white px-6 py-4">
            <h3 class="text-lg font-semibold flex items-center">
                <i class="fas fa-calendar-alt mr-3"></i>
                Jadwal Terbaru
            </h3>
        </div>
        <div class="p-6">
            @if(isset($recentSchedules) && $recentSchedules->count() > 0)
                <div class="space-y-4">
                    @foreach($recentSchedules->take(5) as $schedule)
                    <div class="flex items-center space-x-4 p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-train text-green-600"></i>
                        </div>
                        <div class="flex-1">
                            <h4 class="font-semibold text-gray-900">{{ $schedule->train_name }}</h4>
                            <p class="text-sm text-gray-600">
                                {{ $schedule->route->originStation->code }} → {{ $schedule->route->destinationStation->code }}
                            </p>
                            <div class="text-xs text-gray-500 mt-1">
                                {{ $schedule->formatted_departure_time }} - {{ $schedule->formatted_arrival_time }}
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-lg font-bold text-green-600">{{ $schedule->available_seats }}</div>
                            <div class="text-xs text-gray-500">kursi tersedia</div>
                        </div>
                        <a href="{{ route('admin.schedules.show', $schedule->id) }}" 
                           class="text-green-600 hover:text-green-700 transition-colors duration-300">
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8">
                    <i class="fas fa-calendar-alt text-gray-400 text-4xl mb-4"></i>
                    <p class="text-gray-500">Belum ada jadwal terbaru</p>
                    <a href="{{ route('admin.schedules.create') }}" 
                       class="inline-flex items-center mt-4 px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Jadwal Pertama
                    </a>
                </div>
            @endif
            <div class="mt-6 text-center">
                <a href="{{ route('admin.schedules.index') }}" 
                   class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors duration-300">
                    <span>Lihat Semua Jadwal</span>
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions Section -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-kai-orange to-orange-500 text-white px-6 py-4">
        <h3 class="text-lg font-semibold flex items-center">
            <i class="fas fa-bolt mr-3"></i>
            Aksi Cepat
        </h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('admin.schedules.create') }}" 
               class="flex flex-col items-center p-4 bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl hover:from-kai-blue hover:to-kai-blue-light hover:text-white transition-all duration-300 group">
                <i class="fas fa-calendar-plus text-3xl mb-3 text-kai-blue group-hover:text-white"></i>
                <span class="text-sm font-medium text-center">Tambah Jadwal</span>
            </a>
            <a href="{{ route('admin.routes.create') }}" 
               class="flex flex-col items-center p-4 bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl hover:from-kai-orange hover:to-orange-500 hover:text-white transition-all duration-300 group">
                <i class="fas fa-route text-3xl mb-3 text-kai-orange group-hover:text-white"></i>
                <span class="text-sm font-medium text-center">Tambah Rute</span>
            </a>
            <a href="{{ route('admin.stations.create') }}" 
               class="flex flex-col items-center p-4 bg-gradient-to-br from-green-50 to-green-100 rounded-xl hover:from-green-500 hover:to-emerald-600 hover:text-white transition-all duration-300 group">
                <i class="fas fa-map-marker-alt text-3xl mb-3 text-green-600 group-hover:text-white"></i>
                <span class="text-sm font-medium text-center">Tambah Stasiun</span>
            </a>
            <a href="{{ route('admin.news.create') }}" 
               class="flex flex-col items-center p-4 bg-gradient-to-br from-purple-50 to-purple-100 rounded-xl hover:from-purple-500 hover:to-indigo-600 hover:text-white transition-all duration-300 group">
                <i class="fas fa-newspaper text-3xl mb-3 text-purple-600 group-hover:text-white"></i>
                <span class="text-sm font-medium text-center">Tambah Berita</span>
            </a>
        </div>
    </div>
</div>

<!-- System Information -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
    <div class="bg-gradient-to-r from-gray-600 to-slate-700 text-white px-6 py-4">
        <h3 class="text-lg font-semibold flex items-center">
            <i class="fas fa-info-circle mr-3"></i>
            Informasi Sistem
        </h3>
    </div>
    <div class="p-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-lg font-bold text-gray-900">Laravel</div>
                <div class="text-sm text-gray-600 mt-1">v{{ app()->version() }}</div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-lg font-bold text-gray-900">PHP</div>
                <div class="text-sm text-gray-600 mt-1">{{ PHP_VERSION }}</div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-lg font-bold text-gray-900">Environment</div>
                <div class="text-sm text-gray-600 mt-1">{{ app()->environment() }}</div>
            </div>
            <div class="text-center p-4 bg-gray-50 rounded-lg">
                <div class="text-lg font-bold text-gray-900">Status</div>
                <div class="text-sm text-green-600 mt-1 flex items-center justify-center">
                    <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></div>
                    Online
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Real-time Clock
    function updateClock() {
        const now = new Date();
        const timeString = now.toLocaleTimeString('id-ID', {
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit'
        });
        const dateString = now.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        const timeElement = document.getElementById('current-time');
        const dateElement = document.getElementById('current-date');
        
        if (timeElement) timeElement.textContent = timeString;
        if (dateElement) dateElement.textContent = dateString;
    }
    
    // Update clock immediately and then every second
    updateClock();
    setInterval(updateClock, 1000);
    
    // Animated Counter for Statistics Cards
    function animateCounter(element, target) {
        let current = 0;
        const increment = target / 50;
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString('id-ID');
        }, 30);
    }
    
    // Initialize counters
    document.querySelectorAll('.counter').forEach(counter => {
        const target = parseInt(counter.getAttribute('data-target'));
        if (target) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        animateCounter(counter, target);
                        observer.unobserve(entry.target);
                    }
                });
            });
            observer.observe(counter);
        }
    });
    
    // Welcome message based on time
    const hour = new Date().getHours();
    let greeting = 'datang';
    if (hour < 12) greeting = 'pagi';
    else if (hour < 17) greeting = 'siang';
    else if (hour < 21) greeting = 'sore';
    else greeting = 'malam';
    
    // Update greeting if element exists
    const greetingElement = document.querySelector('h1');
    if (greetingElement && greetingElement.textContent.includes('datang')) {
        greetingElement.textContent = greetingElement.textContent.replace('datang', greeting);
    }
    
    // Add loading states to quick action buttons
    document.querySelectorAll('a[href*="create"]').forEach(link => {
        link.addEventListener('click', function() {
            const icon = this.querySelector('i');
            if (icon && !icon.classList.contains('fa-spinner')) {
                const originalClass = icon.className;
                icon.className = 'fas fa-spinner fa-spin text-3xl mb-3';
                
                // Reset icon after 2 seconds if still on page
                setTimeout(() => {
                    if (icon) {
                        icon.className = originalClass;
                    }
                }, 2000);
            }
        });
    });
    
    // Hover effects for cards
    document.querySelectorAll('.hover\\:shadow-xl, .hover\\:bg-gray-100').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>
@endpush
