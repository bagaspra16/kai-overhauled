@extends('layouts.app')

@section('title', 'Hasil Pencarian Tiket - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section with Search Summary -->
<section class="relative py-20 bg-gradient-to-br from-kai-blue via-kai-blue-light to-kai-blue overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4">
        <div class="max-w-6xl mx-auto text-center text-white">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    <i class="fas fa-search mr-2"></i>
                    Hasil Pencarian
                </span>
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold mb-8 animate-fade-in">
                {{ $schedules->count() }} Jadwal Tersedia
            </h1>

            <!-- Search Summary Card -->
            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20 max-w-4xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm">
                    <div class="text-center md:text-left">
                        <div class="text-kai-white/70 mb-1 font-medium">Dari</div>
                        <div class="font-bold text-lg">{{ $route->originStation->name }}</div>
                        <div class="text-kai-white/80">{{ $route->originStation->city }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-kai-orange text-2xl mb-2">
                            <i class="fas fa-arrow-right"></i>
                        </div>
                        <div class="text-kai-white/70 text-xs">{{ $route->distance_km }} km</div>
                    </div>
                    <div class="text-center md:text-right">
                        <div class="text-kai-white/70 mb-1 font-medium">Ke</div>
                        <div class="font-bold text-lg">{{ $route->destinationStation->name }}</div>
                        <div class="text-kai-white/80">{{ $route->destinationStation->city }}</div>
                    </div>
                    <div class="text-center">
                        <div class="text-kai-white/70 mb-1 font-medium">Tanggal</div>
                        <div class="font-bold">{{ \Carbon\Carbon::parse($searchParams['departure_date'])->format('d M Y') }}</div>
                        <div class="text-kai-white/80">
                            {{ $searchParams['passenger_count'] }} Dewasa
                            @if($searchParams['infant_count'] > 0)
                                + {{ $searchParams['infant_count'] }} Bayi
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Back to Search Button -->
            <div class="mt-8">
                <a href="{{ route('ticket.search') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white border border-white/20 rounded-xl transition-all duration-300 transform hover:scale-105 backdrop-blur-sm">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Ubah Pencarian
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Results Section -->
<section class="py-16 bg-gray-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            
            @if($schedules->count() > 0)
                <!-- Filter & Sort Options -->
                <div class="mb-8 bg-white rounded-xl shadow-sm p-6 border border-gray-200" x-data="filterData()">
                    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h2 class="text-2xl font-bold text-kai-blue mb-2">
                                Pilih Jadwal Keberangkatan
                            </h2>
                            <p class="text-gray-600">
                                Estimasi perjalanan: {{ $route->formatted_duration ?? 'N/A' }} | 
                                <span x-text="filteredCount"></span> dari {{ $schedules->count() }} jadwal ditampilkan
                            </p>
                        </div>
                        
                        <div class="flex flex-wrap gap-3">
                            <select x-model="sortBy" @change="applyFilters()" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-transparent transition-all duration-300">
                                <option value="time">Urutkan: Waktu Keberangkatan</option>
                                <option value="price_low">Urutkan: Harga Terendah</option>
                                <option value="price_high">Urutkan: Harga Tertinggi</option>
                                <option value="duration">Urutkan: Durasi Tercepat</option>
                                <option value="availability">Urutkan: Ketersediaan Kursi</option>
                            </select>
                            <select x-model="classFilter" @change="applyFilters()" 
                                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-transparent transition-all duration-300">
                                <option value="all">Semua Kelas</option>
                                <option value="Eksekutif">Eksekutif</option>
                                <option value="Bisnis">Bisnis</option>
                                <option value="Ekonomi">Ekonomi</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Schedule Cards -->
                <div class="space-y-6" x-data="{ selectedSchedule: null }" id="scheduleContainer">
                    @foreach($schedules as $schedule)
                    <div class="schedule-card bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-200 overflow-hidden"
                         data-class="{{ $schedule->train_class }}"
                         data-price="{{ $schedule->calculated_price }}"
                         data-time="{{ $schedule->departure_time }}"
                         data-duration="{{ $schedule->journey_duration_minutes ?? 0 }}"
                         data-availability="{{ $schedule->available_seats }}">
                        
                        <!-- Main Schedule Info -->
                        <div class="p-6">
                            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
                                
                                <!-- Train Info -->
                                <div class="lg:col-span-3">
                                    <div class="flex items-center mb-3">
                                        <div class="w-12 h-12 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-full flex items-center justify-center mr-4">
                                            <i class="fas fa-train text-white text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-800 text-lg">{{ $schedule->train_name }}</div>
                                            <div class="text-sm text-gray-500">{{ $schedule->train_class }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Journey Timeline -->
                                <div class="lg:col-span-5">
                                    <div class="flex items-center justify-between">
                                        <div class="text-center">
                                            <div class="text-3xl font-bold text-gray-800">{{ $schedule->formatted_departure_time }}</div>
                                            <div class="text-sm text-gray-500 font-medium">{{ $route->originStation->code }}</div>
                                            <div class="text-xs text-gray-400">{{ $route->originStation->name }}</div>
                                        </div>
                                        
                                        <div class="flex-1 mx-6">
                                            <div class="relative">
                                                <div class="h-1 bg-gray-200 w-full rounded-full"></div>
                                                <div class="h-1 bg-gradient-to-r from-kai-blue to-kai-orange w-full rounded-full"></div>
                                                <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 bg-kai-orange text-white text-xs px-3 py-1 rounded-full whitespace-nowrap">
                                                    {{ $schedule->journey_duration }}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="text-center">
                                            <div class="text-3xl font-bold text-gray-800">{{ $schedule->formatted_arrival_time }}</div>
                                            <div class="text-sm text-gray-500 font-medium">{{ $route->destinationStation->code }}</div>
                                            <div class="text-xs text-gray-400">{{ $route->destinationStation->name }}</div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price & Availability -->
                                <div class="lg:col-span-3">
                                    <div class="text-right">
                                        <div class="text-3xl font-bold text-kai-blue mb-2">
                                            Rp {{ number_format($schedule->calculated_price, 0, ',', '.') }}
                                        </div>
                                        <div class="text-sm text-gray-500 mb-3">
                                            Rp {{ number_format($schedule->price_per_person, 0, ',', '.') }}/orang
                                        </div>
                                        
                                        <!-- Seat Availability Indicator -->
                                        <div class="flex items-center justify-end mb-4">
                                            <div class="w-3 h-3 rounded-full mr-2 {{ $schedule->is_almost_full ? 'bg-red-500' : ($schedule->seat_availability_percentage < 50 ? 'bg-yellow-500' : 'bg-green-500') }}"></div>
                                            <span class="text-sm {{ $schedule->is_almost_full ? 'text-red-600 font-medium' : 'text-gray-600' }}">
                                                {{ $schedule->available_seats }} kursi tersisa
                                            </span>
                                        </div>

                                        @if($schedule->is_almost_full)
                                            <div class="text-xs text-red-600 bg-red-50 px-3 py-1 rounded-full inline-block mb-3">
                                                <i class="fas fa-exclamation-triangle mr-1"></i>
                                                Hampir Penuh!
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <!-- Action Button -->
                                <div class="lg:col-span-1">
                                    <button @click="selectedSchedule = selectedSchedule === '{{ $schedule->id }}' ? null : '{{ $schedule->id }}'"
                                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light hover:from-kai-orange-light hover:to-kai-orange text-white font-semibold py-3 px-4 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                        <span x-show="selectedSchedule !== '{{ $schedule->id }}'">
                                            <i class="fas fa-info-circle mr-2"></i>                                
                                        </span>
                                        <span x-show="selectedSchedule === '{{ $schedule->id }}'">
                                            <i class="fas fa-times mr-2"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Expandable Details -->
                        <div x-show="selectedSchedule === '{{ $schedule->id }}'"
                             x-transition:enter="transition ease-out duration-300"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-screen"
                             x-transition:leave="transition ease-in duration-200"
                             x-transition:leave-start="opacity-100 max-h-screen"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="overflow-hidden">
                            
                            <div class="px-6 pb-6 bg-gray-50 border-t border-gray-100">
                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 pt-6">
                                    
                                    <!-- Journey Details -->
                                    <div class="space-y-4">
                                        <h4 class="font-semibold text-gray-800 flex items-center text-lg">
                                            <i class="fas fa-info-circle text-kai-blue mr-3"></i>
                                            Detail Perjalanan
                                        </h4>
                                        <div class="space-y-3 text-sm">
                                            <div class="flex justify-between py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Jarak:</span>
                                                <span class="font-medium">{{ $route->distance_km }} km</span>
                                            </div>
                                            <div class="flex justify-between py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Durasi:</span>
                                                <span class="font-medium">{{ $schedule->journey_duration }}</span>
                                            </div>
                                            <div class="flex justify-between py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Kelas:</span>
                                                <span class="font-medium">{{ $schedule->train_class }}</span>
                                            </div>
                                            <div class="flex justify-between py-2">
                                                <span class="text-gray-600">Kereta:</span>
                                                <span class="font-medium">{{ $schedule->train_name }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Price Breakdown -->
                                    <div class="space-y-4">
                                        <h4 class="font-semibold text-gray-800 flex items-center text-lg">
                                            <i class="fas fa-calculator text-kai-orange mr-3"></i>
                                            Rincian Harga
                                        </h4>
                                        <div class="space-y-3 text-sm">
                                            <div class="flex justify-between py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Harga Dasar:</span>
                                                <span class="font-medium">Rp {{ number_format($route->base_price, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="flex justify-between py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Faktor Harga:</span>
                                                <span class="font-medium">{{ $schedule->price_modifier }}x</span>
                                            </div>
                                            <div class="flex justify-between py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Harga per Orang:</span>
                                                <span class="font-medium">Rp {{ number_format($schedule->price_per_person, 0, ',', '.') }}</span>
                                            </div>
                                            <div class="flex justify-between py-2 border-t-2 border-kai-blue pt-3">
                                                <span class="text-gray-800 font-bold">Total Harga:</span>
                                                <span class="font-bold text-kai-blue text-lg">Rp {{ number_format($schedule->calculated_price, 0, ',', '.') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Seat Information -->
                                    <div class="space-y-4">
                                        <h4 class="font-semibold text-gray-800 flex items-center text-lg">
                                            <i class="fas fa-chair text-green-600 mr-3"></i>
                                            Ketersediaan Kursi
                                        </h4>
                                        <div class="space-y-4">
                                            <div class="flex justify-between text-sm py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Total Kursi:</span>
                                                <span class="font-medium">{{ $schedule->total_seats }}</span>
                                            </div>
                                            <div class="flex justify-between text-sm py-2 border-b border-gray-200">
                                                <span class="text-gray-600">Kursi Tersedia:</span>
                                                <span class="font-medium text-green-600">{{ $schedule->available_seats }}</span>
                                            </div>
                                            
                                            <!-- Availability Progress Bar -->
                                            <div class="space-y-2">
                                                <div class="flex justify-between text-xs text-gray-500">
                                                    <span>Ketersediaan</span>
                                                    <span>{{ $schedule->seat_availability_percentage }}%</span>
                                                </div>
                                                <div class="w-full bg-gray-200 rounded-full h-3">
                                                    <div class="h-3 rounded-full {{ $schedule->is_almost_full ? 'bg-red-500' : ($schedule->seat_availability_percentage < 50 ? 'bg-yellow-500' : 'bg-green-500') }}" 
                                                         style="width: {{ $schedule->seat_availability_percentage }}%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Booking Actions -->
                                    <div class="space-y-4">
                                        <h4 class="font-semibold text-gray-800 flex items-center text-lg">
                                            <i class="fas fa-ticket-alt text-kai-blue mr-3"></i>
                                            Pemesanan
                                        </h4>
                                        <div class="space-y-4">
                                            <button class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light hover:from-kai-blue-light hover:to-kai-blue text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                                                <i class="fas fa-shopping-cart mr-3"></i>
                                                Pesan Tiket
                                            </button>
                                            <button class="w-full bg-white border-2 border-kai-orange text-kai-orange hover:bg-kai-orange hover:text-white font-semibold py-3 px-6 rounded-xl transition-all duration-300">
                                                <i class="fas fa-heart mr-3"></i>
                                                Simpan ke Favorit
                                            </button>
                                            <div class="text-xs text-gray-500 text-center">
                                                <i class="fas fa-info-circle mr-1"></i>
                                                Harga dapat berubah sewaktu-waktu
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

            @else
                <!-- No Results Found -->
                <div class="text-center py-20">
                    <div class="max-w-md mx-auto">
                        <div class="w-32 h-32 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-8">
                            <i class="fas fa-search text-4xl text-gray-400"></i>
                        </div>
                        <h3 class="text-3xl font-bold text-gray-800 mb-4">Tidak Ada Jadwal Tersedia</h3>
                        <p class="text-gray-600 mb-8 text-lg leading-relaxed">
                            Maaf, tidak ada jadwal kereta yang tersedia untuk rute dan tanggal yang Anda pilih. 
                            Silakan coba dengan tanggal lain atau rute berbeda.
                        </p>
                        <div class="space-y-4">
                            <a href="{{ route('ticket.search') }}" 
                               class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-kai-orange to-kai-orange-light text-white font-bold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                <i class="fas fa-search mr-3"></i>
                                Coba Pencarian Lain
                            </a>
                            <div class="text-sm text-gray-500">
                                atau hubungi customer service kami di <strong>1500000</strong>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    // Alpine.js filter data function
    function filterData() {
        return {
            sortBy: 'time',
            classFilter: 'all',
            filteredCount: {{ $schedules->count() }},
            
            init() {
                this.applyFilters();
            },
            
            applyFilters() {
                const scheduleCards = document.querySelectorAll('.schedule-card');
                let visibleCards = [];
                
                // Filter by class
                scheduleCards.forEach(card => {
                    const cardClass = card.dataset.class;
                    const shouldShow = this.classFilter === 'all' || cardClass === this.classFilter;
                    
                    if (shouldShow) {
                        visibleCards.push(card);
                        card.style.display = 'block';
                    } else {
                        card.style.display = 'none';
                    }
                });
                
                // Sort visible cards
                this.sortCards(visibleCards);
                
                // Update filtered count
                this.filteredCount = visibleCards.length;
                
                // Add animation
                this.animateCards(visibleCards);
            },
            
            sortCards(cards) {
                const container = document.getElementById('scheduleContainer');
                
                cards.sort((a, b) => {
                    switch (this.sortBy) {
                        case 'price_low':
                            return parseInt(a.dataset.price) - parseInt(b.dataset.price);
                        case 'price_high':
                            return parseInt(b.dataset.price) - parseInt(a.dataset.price);
                        case 'time':
                            return a.dataset.time.localeCompare(b.dataset.time);
                        case 'duration':
                            return parseInt(a.dataset.duration) - parseInt(b.dataset.duration);
                        case 'availability':
                            return parseInt(b.dataset.availability) - parseInt(a.dataset.availability);
                        default:
                            return 0;
                    }
                });
                
                // Reorder DOM elements
                cards.forEach(card => {
                    container.appendChild(card);
                });
            },
            
            animateCards(cards) {
                cards.forEach((card, index) => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(20px)';
                    
                    setTimeout(() => {
                        card.style.transition = 'all 0.3s ease-out';
                        card.style.opacity = '1';
                        card.style.transform = 'translateY(0)';
                    }, index * 50);
                });
            }
        }
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Auto-scroll to results section
        setTimeout(() => {
            const resultsSection = document.querySelector('section.bg-gray-50');
            if (resultsSection) {
                resultsSection.scrollIntoView({ 
                    behavior: 'smooth', 
                    block: 'start' 
                });
            }
        }, 500);
        
        // Add loading animation to filter changes
        const filterSelects = document.querySelectorAll('select[x-model]');
        filterSelects.forEach(select => {
            select.addEventListener('change', function() {
                const container = document.getElementById('scheduleContainer');
                container.style.opacity = '0.7';
                
                setTimeout(() => {
                    container.style.opacity = '1';
                }, 300);
            });
        });
    });
</script>

<style>
    /* Smooth transitions for filter changes */
    .schedule-card {
        transition: all 0.3s ease-out;
    }
    
    .schedule-card[style*=\"display: none\"] {
        opacity: 0;
        transform: translateY(-20px);
    }
    
    /* Loading state for container */
    #scheduleContainer {
        transition: opacity 0.3s ease-out;
    }
    
    /* Enhanced filter dropdown styling */
    select[x-model]:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        border-color: #3b82f6;
    }
    
    select[x-model] {
        background-image: url('data:image/svg+xml;charset=US-ASCII,<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 4 5\"><path fill=\"%23666\" d=\"M2 0L0 2h4zm0 5L0 3h4z\"/></svg>');
        background-repeat: no-repeat;
        background-position: right 12px center;
        background-size: 12px;
        padding-right: 40px;
        appearance: none;
    }
    
    /* Filter results counter animation */
    span[x-text=\"filteredCount\"] {
        font-weight: 600;
        color: #f97316;
        transition: all 0.3s ease-out;
    }
</style>
@endsection