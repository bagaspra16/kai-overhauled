@extends('admin.layouts.app')

@section('title', 'Edit Stasiun')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-edit mr-3 text-kai-orange"></i>
            Edit Stasiun
        </h1>
        <p class="text-gray-600">Perbarui informasi dan lokasi stasiun</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.stations.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
        <a href="{{ route('admin.stations.show', $station->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-eye mr-2"></i>
            Lihat Stasiun
        </a>
    </div>
</div>

<form action="{{ route('admin.stations.update', $station->id) }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Stasiun Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-train mr-3"></i>
                        Informasi Stasiun
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Kode Stasiun and Name Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Stasiun <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code', $station->code) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('code') border-red-500 @enderror"
                                   placeholder="e.g., GMR"
                                   style="text-transform: uppercase;"
                                   maxlength="5"
                                   required>
                            @error('code')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Stasiun <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $station->name) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('name') border-red-500 @enderror"
                                   placeholder="e.g., Gambir"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris Kota dan Provinsi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                Kota <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="city" 
                                   name="city" 
                                   value="{{ old('city', $station->city) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('city') border-red-500 @enderror"
                                   placeholder="e.g., Jakarta"
                                   required>
                            @error('city')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="province" class="block text-sm font-medium text-gray-700 mb-2">
                                Province <span class="text-red-500">*</span>
                            </label>
                            <select id="province" 
                                    name="province" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('province') border-red-500 @enderror"
                                    required>
                                <option value="">Select Province...</option>
                                @php
                                $provinces = [
                                    'DKI Jakarta', 'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Yogyakarta',
                                    'Banten', 'Sumatera Utara', 'Sumatera Barat', 'Sumatera Selatan', 'Lampung',
                                    'Kalimantan Barat', 'Kalimantan Timur', 'Sulawesi Selatan', 'Sulawesi Utara'
                                ];
                                @endphp
                                @foreach($provinces as $prov)
                                    <option value="{{ $prov }}" {{ old('province', $station->province) == $prov ? 'selected' : '' }}>
                                        {{ $prov }}
                                    </option>
                                @endforeach
                            </select>
                            @error('province')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kartu Koordinat Lokasi -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-map-marker-alt mr-3"></i>
                        Koordinat Lokasi
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Coordinates Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Lintang
                            </label>
                            <input type="number" 
                                   id="latitude" 
                                   name="latitude" 
                                   value="{{ old('latitude', $station->latitude) }}"
                                   step="0.000001"
                                   min="-90"
                                   max="90"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('latitude') border-red-500 @enderror"
                                   placeholder="e.g., -6.175392">
                            @error('latitude')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="longitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Bujur
                            </label>
                            <input type="number" 
                                   id="longitude" 
                                   name="longitude" 
                                   value="{{ old('longitude', $station->longitude) }}"
                                   step="0.000001"
                                   min="-180"
                                   max="180"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('longitude') border-red-500 @enderror"
                                   placeholder="e.g., 106.827153">
                            @error('longitude')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Aksi Lokasi -->
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" 
                                onclick="getCurrentLocation()"
                                class="flex items-center justify-center px-4 py-2 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                            <i class="fas fa-crosshairs mr-2"></i>
                            Dapatkan Lokasi Saat Ini
                        </button>
                        
                        <button type="button" 
                                onclick="openMapPicker()"
                                class="flex items-center justify-center px-4 py-2 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                            <i class="fas fa-map mr-2"></i>
                            Pilih dari Peta
                        </button>
                        
                        <button type="button" 
                                onclick="viewOnMap()"
                                class="flex items-center justify-center px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            Lihat di Google Maps
                        </button>
                    </div>

                    <!-- Pratinjau Koordinat -->
                    <div id="coordinatePreview" class="p-4 bg-gray-50 rounded-lg">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Koordinat Saat Ini:</span>
                            <span id="coordDisplay" class="font-mono text-sm">
                                {{ $station->latitude && $station->longitude ? number_format($station->latitude, 6) . ', ' . number_format($station->longitude, 6) : 'Belum diatur' }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Pratinjau Stasiun -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-eye mr-3"></i>
                        Pratinjau Stasiun
                    </h3>
                </div>
                
                <div class="p-6">
                    <div id="stationPreview" class="bg-gray-50 rounded-lg p-6 text-center">
                        <div class="w-16 h-16 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-train text-kai-blue text-2xl"></i>
                        </div>
                        <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-kai-blue text-white mb-2">
                            <span id="previewCode">{{ $station->code }}</span>
                        </div>
                        <h4 id="previewName" class="font-semibold text-gray-900 mb-1">{{ $station->name }}</h4>
                        <p id="previewLocation" class="text-sm text-gray-600">{{ $station->city }}, {{ $station->province }}</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-3 text-center">Pratinjau langsung dari kartu stasiun</p>
                </div>
            </div>

            <!-- Status Stasiun -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-toggle-on mr-3"></i>
                        Status Stasiun
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Status Aktif</h4>
                            <p class="text-sm text-gray-600">Status operasional stasiun</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $station->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-kai-blue/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kai-blue"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Detail Stasiun -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Detail Stasiun
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">ID Stasiun</span>
                        <span class="font-mono text-kai-blue">#{{ $station->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Dibuat</span>
                        <span class="text-sm">{{ $station->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Terakhir Updated</span>
                        <span class="text-sm">{{ $station->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Perbarui Stasiun
                    </button>
                    
                    <button type="button" 
                            onclick="previewStation()"
                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        Pratinjau Stasiun
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Pratinjau Stasiun</h3>
            <button type="button" onclick="closePreview()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6" id="previewContent">
            <!-- Konten pratinjau akan dimasukkan di sini -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live preview updates
    document.getElementById('code').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
        document.getElementById('previewCode').textContent = this.value || 'CODE';
    });

    document.getElementById('name').addEventListener('input', function() {
        document.getElementById('previewName').textContent = this.value || 'Nama Stasiun';
    });

    document.getElementById('city').addEventListener('input', updateLocationPreview);
    document.getElementById('province').addEventListener('change', updateLocationPreview);

    function updateLocationPreview() {
        const city = document.getElementById('city').value;
        const province = document.getElementById('province').value;
        const location = [city, province].filter(Boolean).join(', ') || 'Kota, Provinsi';
        document.getElementById('previewLocation').textContent = location;
    }

    // Coordinate updates
    document.getElementById('latitude').addEventListener('input', updateCoordinateDisplay);
    document.getElementById('longitude').addEventListener('input', updateCoordinateDisplay);

    function updateCoordinateDisplay() {
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;
        
        if (lat && lng) {
            document.getElementById('coordDisplay').textContent = 
                parseFloat(lat).toFixed(6) + ', ' + parseFloat(lng).toFixed(6);
        } else {
            document.getElementById('coordDisplay').textContent = 'Not set';
        }
    }

    // Get current location
    function getCurrentLocation() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
                updateCoordinateDisplay();
            }, function(error) {
                alert('Error getting location: ' + error.message);
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    }

    // Open map picker
    function openMapPicker() {
        const lat = document.getElementById('latitude').value || -6.175392;
        const lng = document.getElementById('longitude').value || 106.827153;
        const url = `https://www.google.com/maps/@${lat},${lng},15z`;
        window.open(url, '_blank');
        alert('Click on the map to get coordinates, then copy them back to the form.');
    }

    // View on map
    function viewOnMap() {
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;
        
        if (lat && lng) {
            const url = `https://www.google.com/maps?q=${lat},${lng}&z=15`;
            window.open(url, '_blank');
        } else {
            alert('Please enter coordinates first.');
        }
    }

    // Preview station
    function previewStation() {
        const code = document.getElementById('code').value;
        const name = document.getElementById('name').value;
        const city = document.getElementById('city').value;
        const province = document.getElementById('province').value;
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;
        const isActive = document.querySelector('input[name="is_active"]').checked;
        
        let previewHTML = `
            <div class="text-center">
                <div class="w-24 h-24 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-train text-kai-blue text-4xl"></i>
                </div>
                <div class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-kai-blue text-white mb-4">
                    ${code || 'CODE'}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">${name || 'Nama Stasiun'}</h2>
                <p class="text-gray-600 mb-6">${[city, province].filter(Boolean).join(', ') || 'City, Province'}</p>
                
                ${lat && lng ? `
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <h3 class="font-semibold text-gray-900 mb-2">Location</h3>
                    <p class="font-mono text-sm text-gray-600">${parseFloat(lat).toFixed(6)}, ${parseFloat(lng).toFixed(6)}</p>
                </div>
                ` : ''}
                
                <div class="flex items-center justify-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        <i class="fas fa-${isActive ? 'check' : 'times'} mr-1"></i>
                        ${isActive ? 'Active Station' : 'Inactive Station'}
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
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating Station...';
        submitBtn.disabled = true;
    });
</script>
@endpush
