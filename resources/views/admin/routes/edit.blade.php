@extends('admin.layouts.app')

@section('title', 'Edit Rute')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-edit mr-3 text-kai-orange"></i>
            Edit Rute
        </h1>
        <p class="text-gray-600">Perbarui koneksi rute dan harga</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.routes.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
        <a href="{{ route('admin.routes.show', $route->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-eye mr-2"></i>
            Lihat Rute
        </a>
    </div>
</div>

<form action="{{ route('admin.routes.update', $route->id) }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Route Connection Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-route mr-3"></i>
                        Route Connection
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
                                <option value="">Select Origin...</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}" 
                                            data-code="{{ $station->code }}"
                                            data-name="{{ $station->name }}"
                                            {{ old('origin_station_id', $route->origin_station_id) == $station->id ? 'selected' : '' }}>
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
                                <option value="">Select Destination...</option>
                                @foreach($stations as $station)
                                    <option value="{{ $station->id }}" 
                                            data-code="{{ $station->code }}"
                                            data-name="{{ $station->name }}"
                                            {{ old('destination_station_id', $route->destination_station_id) == $station->id ? 'selected' : '' }}>
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

                    <!-- Route Visual Preview -->
                    <div id="routeVisual" class="p-6 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-center space-x-8">
                            <div class="text-center">
                                <div class="w-16 h-16 bg-kai-blue rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-train text-white text-2xl"></i>
                                </div>
                                <div id="originCode" class="font-bold text-kai-blue">{{ $route->originStation->code }}</div>
                                <div id="originName" class="text-sm text-gray-600">{{ $route->originStation->name }}</div>
                            </div>
                            <div class="flex-1 flex items-center justify-center">
                                <div class="w-full border-t-2 border-dashed border-kai-orange"></div>
                            </div>
                            <div class="text-center">
                                <div class="w-16 h-16 bg-kai-orange rounded-full flex items-center justify-center mb-3">
                                    <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                                </div>
                                <div id="destCode" class="font-bold text-kai-orange">{{ $route->destinationStation->code }}</div>
                                <div id="destName" class="text-sm text-gray-600">{{ $route->destinationStation->name }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Detail Rute Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Detail Rute
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Jarak and Durasi Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="distance_km" class="block text-sm font-medium text-gray-700 mb-2">
                                Jarak (KM) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="distance_km" 
                                   name="distance_km" 
                                   value="{{ old('distance_km', $route->distance_km) }}"
                                   min="1"
                                   step="0.1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('distance_km') border-red-500 @enderror"
                                   placeholder="e.g., 125.5"
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
                                   value="{{ old('duration_minutes', $route->duration_minutes) }}"
                                   min="1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('duration_minutes') border-red-500 @enderror"
                                   placeholder="e.g., 180"
                                   required>
                            @error('duration_minutes')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                <span id="durationDisplay">{{ floor($route->duration_minutes / 60) }}h {{ $route->duration_minutes % 60 }}m</span>
                            </p>
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
                                   value="{{ old('base_price', $route->base_price) }}"
                                   min="0"
                                   step="1000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('base_price') border-red-500 @enderror"
                                   placeholder="e.g., 150000"
                                   required>
                            @error('base_price')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                Rp <span id="basePriceDisplay">{{ number_format($route->base_price, 0, ',', '.') }}</span>
                            </p>
                        </div>

                        <div>
                            <label for="infant_price" class="block text-sm font-medium text-gray-700 mb-2">
                                Harga Bayi (IDR) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="infant_price" 
                                   name="infant_price" 
                                   value="{{ old('infant_price', $route->infant_price) }}"
                                   min="0"
                                   step="1000"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('infant_price') border-red-500 @enderror"
                                   placeholder="e.g., 75000"
                                   required>
                            @error('infant_price')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">
                                Rp <span id="infantPriceDisplay">{{ number_format($route->infant_price, 0, ',', '.') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Rute -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-toggle-on mr-3"></i>
                        Status Rute
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Status Aktif</h4>
                            <p class="text-sm text-gray-600">Status operasional rute</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $route->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-kai-blue/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kai-blue"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Detail Rute -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Detail Rute
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Route ID</span>
                        <span class="font-mono text-kai-blue">#{{ $route->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Created</span>
                        <span class="text-sm">{{ $route->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Terakhir Updated</span>
                        <span class="text-sm">{{ $route->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Perbarui Rute
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
    <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Pratinjau Rute</h3>
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
    // Update route visual preview
    function updateRoutePreview() {
        const originSelect = document.getElementById('origin_station_id');
        const destSelect = document.getElementById('destination_station_id');
        
        const originOption = originSelect.options[originSelect.selectedIndex];
        const destOption = destSelect.options[destSelect.selectedIndex];
        
        if (originOption.value) {
            document.getElementById('originCode').textContent = originOption.getAttribute('data-code') || 'ORIGIN';
            document.getElementById('originName').textContent = originOption.getAttribute('data-name') || 'Stasiun Asal';
        }
        
        if (destOption.value) {
            document.getElementById('destCode').textContent = destOption.getAttribute('data-code') || 'DEST';
            document.getElementById('destName').textContent = destOption.getAttribute('data-name') || 'Stasiun Tujuan';
        }
    }

    // Durasi display update
    document.getElementById('duration_minutes').addEventListener('input', function() {
        const menit = parseInt(this.value) || 0;
        const jam = Math.floor(minutes / 60);
        const mins = menit % 60;
        document.getElementById('durationDisplay').textContent = jam + 'h ' + mins + 'm';
    });

    // Price display updates
    document.getElementById('base_price').addEventListener('input', function() {
        const price = parseInt(this.value) || 0;
        document.getElementById('basePriceDisplay').textContent = price.toLocaleString('id-ID');
    });

    document.getElementById('infant_price').addEventListener('input', function() {
        const price = parseInt(this.value) || 0;
        document.getElementById('infantPriceDisplay').textContent = price.toLocaleString('id-ID');
    });

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
        
        const originCode = originOption.getAttribute('data-code') || 'ORIGIN';
        const originName = originOption.getAttribute('data-name') || 'Stasiun Asal';
        const destCode = destOption.getAttribute('data-code') || 'DEST';
        const destName = destOption.getAttribute('data-name') || 'Stasiun Tujuan';
        
        const jam = Math.floor(duration / 60);
        const mins = duration % 60;
        
        let previewHTML = `
            <div class="text-center">
                <div class="flex items-center justify-center space-x-8 mb-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-kai-blue rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-train text-white text-3xl"></i>
                        </div>
                        <div class="font-bold text-kai-blue text-xl">${originCode}</div>
                        <div class="text-gray-600">${originName}</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full border-t-2 border-dashed border-kai-orange relative mb-2">
                            <i class="fas fa-arrow-right text-2xl text-kai-orange absolute -top-3 left-1/2 transform -translate-x-1/2 bg-white px-2"></i>
                        </div>
                        <div class="text-sm text-gray-600">${distance || '0'} km • ${hours}h ${mins}m</div>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-kai-orange rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-map-marker-alt text-white text-3xl"></i>
                        </div>
                        <div class="font-bold text-kai-orange text-xl">${destCode}</div>
                        <div class="text-gray-600">${destName}</div>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Jarak</h4>
                        <p class="text-2xl font-bold text-kai-blue">${distance || '0'} km</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Durasi</h4>
                        <p class="text-2xl font-bold text-kai-orange">${hours}h ${mins}m</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Harga Dasar</h4>
                        <p class="text-2xl font-bold text-green-600">Rp ${parseInt(basePrice || 0).toLocaleString('id-ID')}</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-center">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        <i class="fas fa-${isActive ? 'check' : 'times'} mr-2"></i>
                        ${isActive ? 'Rute Aktif' : 'Rute Tidak Aktif'}
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
        
        if (originId === destId && originId !== '') {
            e.preventDefault();
            alert('Origin and destination stations cannot be the same.');
            return false;
        }
        
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating Route...';
        submitBtn.disabled = true;
    });

    // Initialize displays on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRoutePreview();
    });
</script>
@endpush
