@extends('layouts.app')

@section('title', 'Cari Tiket Kereta - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000" 
         style="background-image: url('{{ asset('assets/kereta-background.jpg') }}');">
        <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
    </div>
    
    <div class="relative z-10 container mx-auto px-4 text-center text-kai-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    <i class="fas fa-ticket-alt mr-2"></i>
                    Cari Tiket
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Temukan Perjalanan Anda
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up mb-8">
                Cari dan pesan tiket kereta api dengan mudah. Nikmati perjalanan yang aman, nyaman, dan terpercaya
            </p>
            
            <!-- Scroll Indicator -->
            <div class="mt-12 animate-bounce">
                <div class="flex flex-col items-center text-kai-white cursor-pointer" @click="window.scrollTo({ top: window.innerHeight, behavior: 'smooth' })">
                    <span class="text-sm mb-2">Mulai Pencarian</span>
                    <i class="fas fa-chevron-down text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Search Form Section -->
<section class="py-16 bg-gray-50" x-data="{ 
    formData: {
        origin_station_id: '{{ old('origin_station_id') }}',
        destination_station_id: '{{ old('destination_station_id') }}',
        departure_date: '{{ old('departure_date') }}',
        passenger_count: {{ old('passenger_count', 1) }},
        infant_count: {{ old('infant_count', 0) }}
    },
    isLoading: false,
    swapStations() {
        // Use the global swapStations function that works with Select2
        if (typeof window.swapStations === 'function') {
            window.swapStations();
        } else {
            // Fallback to original method
            [this.formData.origin_station_id, this.formData.destination_station_id] = 
            [this.formData.destination_station_id, this.formData.origin_station_id];
        }
    }
}">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Section Header -->
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-kai-blue mb-4">
                    <i class="fas fa-search text-kai-orange mr-3"></i>
                    Cari Tiket Kereta
                </h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                    Masukkan detail perjalanan Anda untuk menemukan jadwal dan harga tiket terbaik
                </p>
            </div>

            <!-- Error/Success Messages -->
            @if(session('error'))
            <div class="mb-8 max-w-4xl mx-auto">
                <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-xl relative" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-3 text-lg"></i>
                        <span class="font-medium">{{ session('error') }}</span>
                    </div>
                </div>
            </div>
            @endif

            @if(session('success'))
            <div class="mb-8 max-w-4xl mx-auto">
                <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl relative" role="alert">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle mr-3 text-lg"></i>
                        <span class="font-medium">{{ session('success') }}</span>
                    </div>
                </div>
            </div>
            @endif

            <!-- Search Form -->
            <div class="max-w-4xl mx-auto">
                <form action="{{ route('ticket.search.post') }}" method="POST" 
                      class="bg-white rounded-3xl shadow-2xl p-8 border border-gray-200"
                      x-on:submit="isLoading = true">
                    @csrf
                    
                    <!-- Station Selection Row -->
                    <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mb-8">
                        <!-- Origin Station -->
                        <div class="lg:col-span-2 space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-map-marker-alt text-kai-orange mr-2"></i>
                                Stasiun Keberangkatan
                            </label>
                            <select name="origin_station_id" 
                                    id="origin_station_id"
                                    x-model="formData.origin_station_id"
                                    class="w-full px-4 py-4 border @error('origin_station_id') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-kai-blue focus:border-transparent transition-all duration-300 bg-white shadow-sm hover:shadow-md text-gray-700"
                                    required>
                                <option value="">Pilih Stasiun Keberangkatan</option>
                                @if(isset($stations))
                                    @foreach($stations as $province => $provinceStations)
                                        <optgroup label="{{ $province }}">
                                            @foreach($provinceStations as $station)
                                                <option value="{{ $station->id }}" {{ old('origin_station_id') == $station->id ? 'selected' : '' }}>
                                                    {{ $station->name }} ({{ $station->city }})
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                @endif
                            </select>
                            @error('origin_station_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Swap Button -->
                        <div class="lg:col-span-1 flex items-end justify-center">
                            <button type="button" 
                                    @click="swapStations()"
                                    class="group flex items-center justify-center w-14 h-14 bg-kai-orange/10 hover:bg-kai-orange hover:text-white text-kai-orange rounded-full transition-all duration-300 transform hover:scale-110 shadow-md hover:shadow-lg">
                                <i class="fas fa-exchange-alt text-lg group-hover:rotate-180 transition-transform duration-300"></i>
                            </button>
                        </div>

                        <!-- Destination Station -->
                        <div class="lg:col-span-2 space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-flag-checkered text-kai-orange mr-2"></i>
                                Stasiun Tujuan
                            </label>
                            <select name="destination_station_id" 
                                    id="destination_station_id"
                                    x-model="formData.destination_station_id"
                                    class="w-full px-4 py-4 border @error('destination_station_id') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-kai-blue focus:border-transparent transition-all duration-300 bg-white shadow-sm hover:shadow-md text-gray-700"
                                    required>
                                <option value="">Pilih Stasiun Tujuan</option>
                                @if(isset($stations))
                                    @foreach($stations as $province => $provinceStations)
                                        <optgroup label="{{ $province }}">
                                            @foreach($provinceStations as $station)
                                                <option value="{{ $station->id }}" {{ old('destination_station_id') == $station->id ? 'selected' : '' }}>
                                                    {{ $station->name }} ({{ $station->city }})
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                @endif
                            </select>
                            @error('destination_station_id')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Date and Passenger Row -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <!-- Departure Date -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-calendar-alt text-kai-orange mr-2"></i>
                                Tanggal Keberangkatan
                            </label>
                            <input type="date" 
                                   name="departure_date" 
                                   x-model="formData.departure_date"
                                   value="{{ old('departure_date') }}"
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-4 py-4 border @error('departure_date') border-red-500 @else border-gray-300 @enderror rounded-xl focus:ring-2 focus:ring-kai-blue focus:border-transparent transition-all duration-300 bg-white shadow-sm hover:shadow-md text-gray-700"
                                   required>
                            @error('departure_date')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Adult Passengers -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-user text-kai-orange mr-2"></i>
                                Penumpang Dewasa
                            </label>
                            <select name="passenger_count" 
                                    id="passenger_count"
                                    x-model="formData.passenger_count"
                                    class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-kai-blue focus:border-transparent transition-all duration-300 bg-white shadow-sm hover:shadow-md text-gray-700"
                                    required>
                                @for($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" {{ old('passenger_count', 1) == $i ? 'selected' : '' }}>{{ $i }} Orang</option>
                                @endfor
                            </select>
                        </div>

                        <!-- Infant Passengers -->
                        <div class="space-y-2">
                            <label class="block text-sm font-semibold text-gray-700">
                                <i class="fas fa-baby text-kai-orange mr-2"></i>
                                Bayi (0-2 tahun)
                            </label>
                            <select name="infant_count" 
                                    id="infant_count"
                                    x-model="formData.infant_count"
                                    class="w-full px-4 py-4 border border-gray-300 rounded-xl focus:ring-2 focus:ring-kai-blue focus:border-transparent transition-all duration-300 bg-white shadow-sm hover:shadow-md text-gray-700">
                                @for($i = 0; $i <= 4; $i++)
                                    <option value="{{ $i }}" {{ old('infant_count', 0) == $i ? 'selected' : '' }}>{{ $i }} Bayi</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <!-- Search Button -->
                    <div class="text-center">
                        <button type="submit" 
                                :disabled="isLoading"
                                class="group relative inline-flex items-center justify-center px-12 py-4 bg-gradient-to-r from-kai-orange to-kai-orange-light hover:from-kai-orange-light hover:to-kai-orange text-white font-bold text-lg rounded-full transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-2xl hover:shadow-3xl disabled:opacity-50 disabled:cursor-not-allowed min-w-[200px]">
                            <span class="relative z-10 flex items-center" x-show="!isLoading">
                                <i class="fas fa-search mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                                Cari Tiket
                            </span>
                            <span class="relative z-10 flex items-center" x-show="isLoading">
                                <i class="fas fa-spinner fa-spin mr-3"></i>
                                Mencari Tiket...
                            </span>
                            <div class="absolute inset-0 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-full blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Popular Routes Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-kai-blue mb-4">
                    <i class="fas fa-fire text-kai-orange mr-3"></i>
                    Rute Populer
                </h2>
                <p class="text-xl text-gray-600">
                    Rute kereta api yang paling banyak dicari
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @if(isset($popularRoutes) && $popularRoutes->count() > 0)
                    @foreach($popularRoutes as $route)
                    <div class="group bg-gradient-to-br from-kai-blue to-kai-blue-light hover:from-kai-blue-light hover:to-kai-blue text-white rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 shadow-lg hover:shadow-2xl cursor-pointer"
                         onclick="selectRoute('{{ $route->origin_station_id }}', '{{ $route->destination_station_id }}')">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="font-bold text-lg">{{ $route->originStation->name }}</div>
                                <div class="text-sm opacity-75">{{ $route->originStation->city }}</div>
                            </div>
                            <div class="text-kai-orange mx-4">
                                <i class="fas fa-arrow-right text-2xl group-hover:translate-x-2 transition-transform duration-300"></i>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-lg">{{ $route->destinationStation->name }}</div>
                                <div class="text-sm opacity-75">{{ $route->destinationStation->city }}</div>
                            </div>
                        </div>
                        <div class="text-center text-sm opacity-75">
                            <i class="fas fa-chart-line mr-2"></i>
                            {{ $route->query_count }} pencarian bulan ini
                        </div>
                    </div>
                    @endforeach
                @else
                    <!-- Default Popular Routes -->
                    <div class="group bg-gradient-to-br from-kai-blue to-kai-blue-light hover:from-kai-blue-light hover:to-kai-blue text-white rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 shadow-lg hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="font-bold text-lg">Jakarta</div>
                                <div class="text-sm opacity-75">Gambir</div>
                            </div>
                            <div class="text-kai-orange mx-4">
                                <i class="fas fa-arrow-right text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-lg">Bandung</div>
                                <div class="text-sm opacity-75">Bandung</div>
                            </div>
                        </div>
                        <div class="text-center text-sm opacity-75">
                            <i class="fas fa-star mr-2"></i>
                            Rute Favorit
                        </div>
                    </div>

                    <div class="group bg-gradient-to-br from-kai-blue to-kai-blue-light hover:from-kai-blue-light hover:to-kai-blue text-white rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 shadow-lg hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="font-bold text-lg">Jakarta</div>
                                <div class="text-sm opacity-75">Gambir</div>
                            </div>
                            <div class="text-kai-orange mx-4">
                                <i class="fas fa-arrow-right text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-lg">Yogyakarta</div>
                                <div class="text-sm opacity-75">Yogyakarta</div>
                            </div>
                        </div>
                        <div class="text-center text-sm opacity-75">
                            <i class="fas fa-star mr-2"></i>
                            Rute Favorit
                        </div>
                    </div>

                    <div class="group bg-gradient-to-br from-kai-blue to-kai-blue-light hover:from-kai-blue-light hover:to-kai-blue text-white rounded-2xl p-6 transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 shadow-lg hover:shadow-2xl">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <div class="font-bold text-lg">Jakarta</div>
                                <div class="text-sm opacity-75">Gambir</div>
                            </div>
                            <div class="text-kai-orange mx-4">
                                <i class="fas fa-arrow-right text-2xl"></i>
                            </div>
                            <div class="text-right">
                                <div class="font-bold text-lg">Surabaya</div>
                                <div class="text-sm opacity-75">Gubeng</div>
                            </div>
                        </div>
                        <div class="text-center text-sm opacity-75">
                            <i class="fas fa-star mr-2"></i>
                            Rute Favorit
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl font-bold text-kai-blue mb-4">
                    Mengapa Memilih KAI?
                </h2>
                <p class="text-xl text-gray-600">
                    Nikmati kemudahan dan kenyamanan dalam setiap perjalanan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-clock text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Tepat Waktu</h3>
                    <p class="text-gray-600">Kereta api selalu berangkat dan tiba sesuai jadwal yang telah ditentukan</p>
                </div>

                <div class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-shield-alt text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Aman & Nyaman</h3>
                    <p class="text-gray-600">Perjalanan yang aman dengan fasilitas modern dan pelayanan terbaik</p>
                </div>

                <div class="group text-center p-8 bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2">
                    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:scale-110 transition-transform duration-300">
                        <i class="fas fa-leaf text-2xl text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Ramah Lingkungan</h3>
                    <p class="text-gray-600">Transportasi yang berkelanjutan dan peduli terhadap lingkungan</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<style>
    /* Custom Select2 styling for better size control */
    .select2-container .select2-dropdown {
        max-width: 100% !important;
        width: auto !important;
        min-width: fit-content !important;
    }
    
    .select2-container--default .select2-results__option {
        padding: 6px 12px;
        font-size: 14px;
        white-space: nowrap;
    }
    
    .select2-container--default .select2-search--dropdown .select2-search__field {
        padding: 6px 12px;
        font-size: 14px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        margin: 4px 4px 4px 12px;
        width: calc(100% - 16px) !important;
    }
    
    .select2-container--default .select2-results__group {
        padding: 6px 12px;
        font-weight: 600;
        color: #374151;
        background-color: #f9fafb;
    }
    
    /* Limit dropdown height and width */
    .select2-container--default .select2-results > .select2-results__options {
        max-height: 200px;
    }
    
    /* Specific styling for passenger and infant count dropdowns */
    #passenger_count + .select2-container .select2-dropdown,
    #infant_count + .select2-container .select2-dropdown {
        min-width: 120px !important;
        max-width: 200px !important;
    }
    
    #passenger_count + .select2-container .select2-search--dropdown,
    #infant_count + .select2-container .select2-search--dropdown {
        padding: 4px;
    }
    
    #passenger_count + .select2-container .select2-search--dropdown .select2-search__field,
    #infant_count + .select2-container .select2-search--dropdown .select2-search__field {
        padding: 4px 8px;
        font-size: 13px;
        margin: 2px 2px 2px 10px;
        width: calc(100% - 12px) !important;
    }
    
    /* Style the selection container to match form inputs */
    .select2-container--default .select2-selection--single {
        height: 56px !important;
        border: 1px solid #d1d5db !important;
        border-radius: 12px !important;
        padding: 0 16px !important;
        display: flex !important;
        align-items: center !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        padding: 0 !important;
        line-height: normal !important;
        color: #374151 !important;
    }
    
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 54px !important;
        right: 16px !important;
    }
    
    .select2-container--default.select2-container--focus .select2-selection--single {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1) !important;
    }
    
    /* Ensure dropdown doesn't overflow container */
    .select2-container--open .select2-dropdown {
        z-index: 9999;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }
    
    /* Prevent horizontal overflow */
    .select2-dropdown {
        overflow-x: hidden !important;
    }
    
    /* Better positioning for small dropdowns */
    .select2-container--default .select2-dropdown--below {
        border-top: none;
        margin-top: -1px;
    }
    
    .select2-container--default .select2-dropdown--above {
        border-bottom: none;
        margin-bottom: -1px;
    }
</style>
<script>
    // Set default departure date to tomorrow
    document.addEventListener('DOMContentLoaded', function() {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const dateInput = document.querySelector('input[name="departure_date"]');
        if (dateInput && !dateInput.value) {
            dateInput.value = tomorrow.toISOString().split('T')[0];
        }
        
        // Initialize Select2 for all select elements except date input
        initializeSelect2();
    });

    // Initialize Select2
    function initializeSelect2() {
        // Origin Station Select2
        $('#origin_station_id').select2({
            placeholder: 'Pilih Stasiun Keberangkatan',
            allowClear: true,
            width: '100%',
            dropdownAutoWidth: true,
            language: {
                noResults: function() {
                    return "Tidak ada stasiun ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });

        // Destination Station Select2
        $('#destination_station_id').select2({
            placeholder: 'Pilih Stasiun Tujuan',
            allowClear: true,
            width: '100%',
            dropdownAutoWidth: true,
            language: {
                noResults: function() {
                    return "Tidak ada stasiun ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });

        // Passenger Count Select2 - Now with search enabled
        $('#passenger_count').select2({
            placeholder: 'Pilih Jumlah Penumpang',
            allowClear: false,
            width: '100%',
            dropdownAutoWidth: true,
            dropdownParent: $('#passenger_count').parent(),
            minimumResultsForSearch: 0, // Enable search
            language: {
                noResults: function() {
                    return "Tidak ada hasil ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });

        // Infant Count Select2 - Now with search enabled
        $('#infant_count').select2({
            placeholder: 'Pilih Jumlah Bayi',
            allowClear: false,
            width: '100%',
            dropdownAutoWidth: true,
            dropdownParent: $('#infant_count').parent(),
            minimumResultsForSearch: 0, // Enable search
            language: {
                noResults: function() {
                    return "Tidak ada hasil ditemukan";
                },
                searching: function() {
                    return "Mencari...";
                }
            }
        });

        // Update Alpine.js data when Select2 changes
        $('#origin_station_id').on('change', function() {
            const alpineData = Alpine.$data(document.querySelector('[x-data]'));
            if (alpineData) {
                alpineData.formData.origin_station_id = $(this).val();
            }
        });

        $('#destination_station_id').on('change', function() {
            const alpineData = Alpine.$data(document.querySelector('[x-data]'));
            if (alpineData) {
                alpineData.formData.destination_station_id = $(this).val();
            }
        });

        $('#passenger_count').on('change', function() {
            const alpineData = Alpine.$data(document.querySelector('[x-data]'));
            if (alpineData) {
                alpineData.formData.passenger_count = $(this).val();
            }
        });

        $('#infant_count').on('change', function() {
            const alpineData = Alpine.$data(document.querySelector('[x-data]'));
            if (alpineData) {
                alpineData.formData.infant_count = $(this).val();
            }
        });
    }

    // Function to select popular route
    function selectRoute(originId, destinationId) {
        // Set values using Select2
        $('#origin_station_id').val(originId).trigger('change');
        $('#destination_station_id').val(destinationId).trigger('change');
        
        // Update Alpine.js data
        if (window.Alpine) {
            const alpineData = Alpine.$data(document.querySelector('[x-data]'));
            alpineData.formData.origin_station_id = originId;
            alpineData.formData.destination_station_id = destinationId;
        }
        
        // Scroll to form
        document.querySelector('form').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
        });
    }

    // Enhanced swap stations function for Select2
    function swapStations() {
        const originValue = $('#origin_station_id').val();
        const destinationValue = $('#destination_station_id').val();
        
        // Swap the values
        $('#origin_station_id').val(destinationValue).trigger('change');
        $('#destination_station_id').val(originValue).trigger('change');
        
        // Update Alpine.js data
        if (window.Alpine) {
            const alpineData = Alpine.$data(document.querySelector('[x-data]'));
            alpineData.formData.origin_station_id = destinationValue;
            alpineData.formData.destination_station_id = originValue;
        }
    }

    // Make swapStations globally available
    window.swapStations = swapStations;
</script>
@endsection