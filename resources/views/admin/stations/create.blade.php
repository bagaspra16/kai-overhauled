@extends('admin.layouts.app')

@section('title', 'Buat Stasiun')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-plus mr-3 text-kai-orange"></i>
            Buat Stasiun
        </h1>
        <p class="text-gray-600">Tambah stasiun kereta api baru ke jaringan</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.stations.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
    </div>
</div>

<form action="{{ route('admin.stations.store') }}" method="POST" class="space-y-8">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Detail Stasiun Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-train mr-3"></i>
                        Informasi Stasiun
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Kode Stasiun & Nama Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="code" class="block text-sm font-medium text-gray-700 mb-2">
                                Kode Stasiun <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="code" 
                                   name="code" 
                                   value="{{ old('code') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('code') border-red-500 @enderror"
                                   placeholder="e.g., GMR, BD, YK"
                                   maxlength="5"
                                   style="text-transform: uppercase;"
                                   required>
                            @error('code')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500">3-5 character unique code</p>
                        </div>

                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Stasiun <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('name') border-red-500 @enderror"
                                   placeholder="e.g., Gambir, Bandung, Yogyakarta"
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris Lokasi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 mb-2">
                                Kota <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="city" 
                                   name="city" 
                                   value="{{ old('city') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('city') border-red-500 @enderror"
                                   placeholder="e.g., Jakarta, Bandung, Yogyakarta"
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
                                <option value="DKI Jakarta" {{ old('province') == 'DKI Jakarta' ? 'selected' : '' }}>DKI Jakarta</option>
                                <option value="Jawa Barat" {{ old('province') == 'Jawa Barat' ? 'selected' : '' }}>Jawa Barat</option>
                                <option value="Jawa Tengah" {{ old('province') == 'Jawa Tengah' ? 'selected' : '' }}>Jawa Tengah</option>
                                <option value="DI Yogyakarta" {{ old('province') == 'DI Yogyakarta' ? 'selected' : '' }}>DI Yogyakarta</option>
                                <option value="Jawa Timur" {{ old('province') == 'Jawa Timur' ? 'selected' : '' }}>Jawa Timur</option>
                                <option value="Banten" {{ old('province') == 'Banten' ? 'selected' : '' }}>Banten</option>
                                <option value="Sumatera Utara" {{ old('province') == 'Sumatera Utara' ? 'selected' : '' }}>Sumatera Utara</option>
                                <option value="Sumatera Barat" {{ old('province') == 'Sumatera Barat' ? 'selected' : '' }}>Sumatera Barat</option>
                                <option value="Sumatera Selatan" {{ old('province') == 'Sumatera Selatan' ? 'selected' : '' }}>Sumatera Selatan</option>
                            </select>
                            @error('province')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris Koordinat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="latitude" class="block text-sm font-medium text-gray-700 mb-2">
                                Lintang
                            </label>
                            <input type="number" 
                                   id="latitude" 
                                   name="latitude" 
                                   value="{{ old('latitude') }}"
                                   step="0.000001"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('latitude') border-red-500 @enderror"
                                   placeholder="e.g., -6.1754">
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
                                   value="{{ old('longitude') }}"
                                   step="0.000001"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('longitude') border-red-500 @enderror"
                                   placeholder="e.g., 106.8272">
                            @error('longitude')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Dapatkan Lokasi Saat Ini -->
                    <div class="flex items-center justify-center">
                        <button type="button" 
                                onclick="getCurrentLocation()"
                                class="flex items-center px-4 py-2 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            Dapatkan Lokasi Saat Ini
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status Stasiun -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-toggle-on mr-3"></i>
                        Status Stasiun
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-900">Status Aktif</h4>
                                <p class="text-sm text-gray-600">Status operasional stasiun</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" class="sr-only peer" checked>
                                <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-kai-blue/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kai-blue"></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pratinjau Lokasi -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-map mr-3"></i>
                        Pratinjau Lokasi
                    </h3>
                </div>
                
                <div class="p-6">
                    <div id="locationPreview" class="text-center py-8 bg-gray-50 rounded-lg">
                        <i class="fas fa-map-marker-alt text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Masukkan koordinat untuk pratinjau lokasi</p>
                    </div>
                    
                    <div class="mt-4 text-sm text-gray-600">
                        <p class="mb-2"><strong>Tips:</strong></p>
                        <ul class="space-y-1 text-xs">
                            <li>• Gunakan format derajat desimal</li>
                            <li>• Lintang: -90 to 90</li>
                            <li>• Bujur: -180 to 180</li>
                            <li>• Klik "Dapatkan Lokasi Saat Ini" untuk isi otomatis</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Buat Stasiun
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
    // Auto-uppercase station code
    document.getElementById('code').addEventListener('input', function() {
        this.value = this.value.toUpperCase();
    });

    // Update location preview when coordinates change
    function updateLocationPreview() {
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;
        const preview = document.getElementById('locationPreview');
        
        if (lat && lng) {
            preview.innerHTML = `
                <div class="text-center">
                    <i class="fas fa-map-marker-alt text-4xl text-kai-blue mb-4"></i>
                    <p class="font-medium text-gray-900">Koordinat Lokasi</p>
                    <p class="text-sm text-gray-600 mt-2">
                        Lat: <span class="font-mono text-kai-blue">${parseFloat(lat).toFixed(6)}</span><br>
                        Lng: <span class="font-mono text-kai-orange">${parseFloat(lng).toFixed(6)}</span>
                    </p>
                </div>
            `;
        } else {
            preview.innerHTML = `
                <i class="fas fa-map-marker-alt text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">Masukkan koordinat untuk pratinjau lokasi</p>
            `;
        }
    }

    // Add event listeners for coordinate inputs
    document.getElementById('latitude').addEventListener('input', updateLocationPreview);
    document.getElementById('longitude').addEventListener('input', updateLocationPreview);

    // Get current location
    function getCurrentLocation() {
        if (navigator.geolocation) {
            const button = event.target;
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mendapatkan Lokasi...';
            button.disabled = true;
            
            navigator.geolocation.getCurrentPosition(
                function(position) {
                    document.getElementById('latitude').value = position.coords.latitude.toFixed(6);
                    document.getElementById('longitude').value = position.coords.longitude.toFixed(6);
                    updateLocationPreview();
                    
                    button.innerHTML = '<i class="fas fa-map-marker-alt mr-2"></i>Dapatkan Lokasi Saat Ini';
                    button.disabled = false;
                },
                function(error) {
                    alert('Error mendapatkan lokasi: ' + error.message);
                    button.innerHTML = '<i class="fas fa-map-marker-alt mr-2"></i>Dapatkan Lokasi Saat Ini';
                    button.disabled = false;
                }
            );
        } else {
            alert('Geolocation tidak didukung oleh browser ini.');
        }
    }

    // Preview station
    function previewStation() {
        const code = document.getElementById('code').value;
        const name = document.getElementById('name').value;
        const city = document.getElementById('city').value;
        const province = document.getElementById('province').value;
        const latitude = document.getElementById('latitude').value;
        const longitude = document.getElementById('longitude').value;
        const isActive = document.querySelector('input[name="is_active"]').checked;
        
        let previewHTML = `
            <div class="text-center">
                <div class="w-20 h-20 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-train text-kai-blue text-3xl"></i>
                </div>
                <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-bold bg-kai-blue text-white mb-2">
                    ${code || 'CODE'}
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">${name || 'Nama Stasiun'}</h2>
                
                <div class="grid grid-cols-2 gap-4 mb-6 text-left">
                    <div>
                        <h4 class="font-medium text-gray-700">City</h4>
                        <p class="text-gray-900">${city || 'City'}</p>
                    </div>
                    <div>
                        <h4 class="font-medium text-gray-700">Province</h4>
                        <p class="text-gray-900">${province || 'Province'}</p>
                    </div>
        `;
        
        if (latitude && longitude) {
            previewHTML += `
                    <div class="col-span-2">
                        <h4 class="font-medium text-gray-700">Coordinates</h4>
                        <p class="text-gray-900 font-mono text-sm">
                            ${parseFloat(latitude).toFixed(6)}, ${parseFloat(longitude).toFixed(6)}
                        </p>
                    </div>
            `;
        }
        
        previewHTML += `
                </div>
                
                <div class="flex items-center justify-center">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        <i class="fas fa-${isActive ? 'check' : 'times'} mr-1"></i>
                        ${isActive ? 'Active' : 'Inactive'}
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
        const code = document.getElementById('code').value.trim();
        const name = document.getElementById('name').value.trim();
        const city = document.getElementById('city').value.trim();
        const province = document.getElementById('province').value;
        
        if (!code || !name || !city || !province) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        if (code.length < 3) {
            e.preventDefault();
            alert('Station code must be at least 3 characters.');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Station...';
        submitBtn.disabled = true;
    });
</script>
@endpush
