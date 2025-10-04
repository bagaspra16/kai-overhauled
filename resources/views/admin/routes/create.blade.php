@extends('admin.layouts.app')

@section('title', 'Buat Rute')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-plus mr-3 text-kai-orange"></i>
            Buat Rute
        </h1>
        <p class="text-gray-600">Tambah koneksi rute kereta api baru</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.routes.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
    </div>
</div>

<form action="{{ route('admin.routes.store') }}" method="POST" class="space-y-8">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Detail Rute Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-route mr-3"></i>
                        Informasi Rute
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Baris Pemilihan Stasiun -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="origin_station_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Stasiun Asal <span class="text-red-500">*</span>
                            </label>
                            <select id="origin_station_id" 
                                    name="origin_station_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('origin_station_id') border-red-500 @enderror"
                                    onchange="updateRoutePreview()"
                                    required>
                                <option value="">Pilih Stasiun Asal...</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}" 
                                            data-code="{{ $station->code }}" 
                                            data-name="{{ $station->name }}"
                                            {{ old('origin_station_id') == $station->id ? 'selected' : '' }}>
                                        {{ $station->code }} - {{ $station->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('origin_station_id')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="destination_station_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Stasiun Tujuan <span class="text-red-500">*</span>
                            </label>
                            <select id="destination_station_id" 
                                    name="destination_station_id" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('destination_station_id') border-red-500 @enderror"
                                    onchange="updateRoutePreview()"
                                    required>
                                <option value="">Pilih Stasiun Tujuan...</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}" 
                                            data-code="{{ $station->code }}" 
                                            data-name="{{ $station->name }}"
                                            {{ old('destination_station_id') == $station->id ? 'selected' : '' }}>
                                        {{ $station->code }} - {{ $station->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('destination_station_id')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Jarak & Durasi Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="distance_km" class="block text-sm font-medium text-gray-700 mb-2">
                                Jarak (KM) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="distance_km" 
                                   name="distance_km" 
                                   value="{{ old('distance_km') }}"
                                   min="1"
                                   step="0.1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('distance_km') border-red-500 @enderror"
                                   placeholder="e.g., 150.5"
                                   required>
                            @error('distance_km')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="duration_minutes" class="block text-sm font-medium text-gray-700 mb-2">
                                Durasi (Minutes) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="duration_minutes" 
                                   name="duration_minutes" 
                                   value="{{ old('duration_minutes') }}"
                                   min="1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('duration_minutes') border-red-500 @enderror"
                                   placeholder="e.g., 180"
                                   onchange="updateDurasiDisplay()"
                                   required>
                            @error('duration_minutes')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500" id="durationDisplay">Enter duration to see formatted time</p>
                        </div>
                    </div>

                    <!-- Pricing Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="base_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Dasar (IDR) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="base_price" 
                                   name="base_price" 
                                   value="{{ old('base_price') }}"
                                   min="0"
                                   step="1000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('base_price') border-red-500 @enderror"
                                   placeholder="e.g., 150000"
                                   onchange="updatePriceDisplay()"
                                   required>
                            @error('base_price')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500" id="basePriceDisplay">Harga tiket dewasa</p>
                        </div>

                        <div>
                            <label for="infant_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Bayi (IDR) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="infant_price" 
                                   name="infant_price" 
                                   value="{{ old('infant_price') }}"
                                   min="0"
                                   step="1000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('infant_price') border-red-500 @enderror"
                                   placeholder="e.g., 75000"
                                   onchange="updatePriceDisplay()"
                                   required>
                            @error('infant_price')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500" id="infantPriceDisplay">Harga tiket anak/bayi</p>
                        </div>
                    </div>

                    <!-- Auto-calculate infant price button -->
                    <div class="flex items-center justify-center">
                        <button type="button" 
                                onclick="autoCalculateInfantPrice()"
                                class="flex items-center px-4 py-2 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                            <i class="fas fa-calculator mr-2"></i>
                            Hitung Otomatis Harga Bayi (50%)
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Pratinjau Rute -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-map-signs mr-3"></i>
                        Pratinjau Rute
                    </h3>
                </div>
                
                <div class="p-6">
                    <div id="routePreview" class="text-center py-8 bg-gray-50 rounded-lg">
                        <i class="fas fa-route text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Pilih stasiun untuk pratinjau rute</p>
                    </div>
                </div>
            </div>

            <!-- Status Rute -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-toggle-on mr-3"></i>
                        Status Rute
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-900">Status Aktif</h4>
                                <p class="text-sm text-gray-600">Status operasional rute</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-kai-blue/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kai-blue"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Buat Rute
                    </button>
                    
                    <button type="button" 
                            onclick="previewRoute()"
                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        Pratinjau Rute
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-3xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Route Preview</h3>
            <button type="button" onclick="closePreview()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6" id="previewContent">
            <!-- Preview content will be inserted here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Update route preview when stations are selected
    function updateRoutePreview() {
        const originSelect = document.getElementById('origin_station_id');
        const destSelect = document.getElementById('destination_station_id');
        const preview = document.getElementById('routePreview');
        
        const originOption = originSelect.options[originSelect.selectedIndex];
        const destOption = destSelect.options[destSelect.selectedIndex];
        
        if (originSelect.value && destSelect.value) {
            if (originSelect.value === destSelect.value) {
                preview.innerHTML = `
                    <div class="text-center py-4">
                        <i class="fas fa-exclamation-triangle text-4xl text-red-400 mb-4"></i>
                        <p class="text-red-600">Origin and destination cannot be the same</p>
                    </div>
                `;
                return;
            }
            
            const originCode = originOption.getAttribute('data-code');
            const originName = originOption.getAttribute('data-name');
            const destCode = destOption.getAttribute('data-code');
            const destName = destOption.getAttribute('data-name');
            
            preview.innerHTML = `
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-kai-blue rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-train text-white"></i>
                            </div>
                            <div class="font-bold text-kai-blue">${originCode}</div>
                            <div class="text-xs text-gray-600">${originName}</div>
                        </div>
                        <div class="flex-1">
                            <i class="fas fa-arrow-right text-2xl text-kai-orange"></i>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-kai-orange rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="font-bold text-kai-orange">${destCode}</div>
                            <div class="text-xs text-gray-600">${destName}</div>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600">${originName} → ${destName}</p>
                </div>
            `;
        } else {
            preview.innerHTML = `
                <i class="fas fa-route text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">Select stations to preview route</p>
            `;
        }
    }

    // Update duration display
    function updateDurasiDisplay() {
        const menit = parseInt(document.getElementById('duration_minutes').value);
        const display = document.getElementById('durationDisplay');
        
        if (minutes) {
            const jam = Math.floor(minutes / 60);
            const mins = menit % 60;
            display.textContent = `${hours}h ${mins}m`;
        } else {
            display.textContent = 'Enter duration to see formatted time';
        }
    }

    // Update price display
    function updatePriceDisplay() {
        const basePrice = parseInt(document.getElementById('base_price').value);
        const infantPrice = parseInt(document.getElementById('infant_price').value);
        
        const basePriceDisplay = document.getElementById('basePriceDisplay');
        const infantPriceDisplay = document.getElementById('infantPriceDisplay');
        
        if (basePrice) {
            basePriceDisplay.textContent = `Rp ${basePrice.toLocaleString('id-ID')}`;
        } else {
            basePriceDisplay.textContent = 'Adult ticket price';
        }
        
        if (infantPrice) {
            infantPriceDisplay.textContent = `Rp ${infantPrice.toLocaleString('id-ID')}`;
        } else {
            infantPriceDisplay.textContent = 'Child/infant ticket price';
        }
    }

    // Auto-calculate infant price (50% dari base price)
    function autoCalculateInfantPrice() {
        const basePrice = parseInt(document.getElementById('base_price').value);
        if (basePrice) {
            const infantPrice = Math.round(basePrice * 0.5);
            document.getElementById('infant_price').value = infantPrice;
            updatePriceDisplay();
        } else {
            alert('Please enter base price first');
        }
    }

    // Preview route
    function previewRoute() {
        const originSelect = document.getElementById('origin_station_id');
        const destSelect = document.getElementById('destination_station_id');
        const distance = document.getElementById('distance_km').value;
        const duration = document.getElementById('duration_minutes').value;
        const basePrice = document.getElementById('base_price').value;
        const infantPrice = document.getElementById('infant_price').value;
        const isActive = document.querySelector('input[name="is_active"]').checked;
        
        const originOption = originSelect.options[originSelect.selectedIndex];
        const destOption = destSelect.options[destSelect.selectedIndex];
        
        if (!originSelect.value || !destSelect.value) {
            alert('Please select both origin and destination stations');
            return;
        }
        
        const originCode = originOption.getAttribute('data-code');
        const originName = originOption.getAttribute('data-name');
        const destCode = destOption.getAttribute('data-code');
        const destName = destOption.getAttribute('data-name');
        
        const jam = Math.floor(duration / 60);
        const mins = duration % 60;
        
        let previewHTML = `
            <div class="text-center">
                <div class="flex items-center justify-center space-x-6 mb-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-kai-blue rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-train text-white text-2xl"></i>
                        </div>
                        <div class="font-bold text-kai-blue text-lg">${originCode || 'ORIGIN'}</div>
                        <div class="text-sm text-gray-600">${originName || 'Stasiun Asal'}</div>
                    </div>
                    <div class="flex-1 flex items-center justify-center">
                        <div class="w-full border-t-2 border-dashed border-kai-orange relative">
                            <i class="fas fa-arrow-right text-2xl text-kai-orange absolute -top-3 left-1/2 transform -translate-x-1/2 bg-white px-2"></i>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-kai-orange rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                        <div class="font-bold text-kai-orange text-lg">${destCode || 'DEST'}</div>
                        <div class="text-sm text-gray-600">${destName || 'Stasiun Tujuan'}</div>
                    </div>
                </div>
                
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Jarak</h4>
                        <p class="text-2xl font-bold text-kai-blue">${distance || '0'} km</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Durasi</h4>
                        <p class="text-2xl font-bold text-kai-orange">${duration ? jam + 'h ' + mins + 'm' : '0h 0m'}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Base Price</h4>
                        <p class="text-xl font-bold text-green-600">Rp ${basePrice ? parseInt(basePrice).toLocaleString('id-ID') : '0'}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Harga Bayi</h4>
                        <p class="text-xl font-bold text-green-600">Rp ${infantPrice ? parseInt(infantPrice).toLocaleString('id-ID') : '0'}</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-center">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        <i class="fas fa-${isActive ? 'check' : 'times'} mr-2"></i>
                        ${isActive ? 'Active Route' : 'Inactive Route'}
                    </span>
                </div>
            </div>
        `;
        
        document.getElementById('previewContent').innerHTML = previewHTML;
        document.getElementById('previewModal').classList.remove('hidden');
    }

    // Tutup preview
    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const originId = document.getElementById('origin_station_id').value;
        const destId = document.getElementById('destination_station_id').value;
        
        if (originId === destId) {
            e.preventDefault();
            alert('Origin and destination stations cannot be the same.');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Route...';
        submitBtn.disabled = true;
    });

    // Initialize displays on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRoutePreview();
        updateDurasiDisplay();
        updatePriceDisplay();
    });
</script>
@endpush
