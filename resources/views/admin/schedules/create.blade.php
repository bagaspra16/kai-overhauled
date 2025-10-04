@extends('admin.layouts.app')

@section('title', 'Buat Jadwal')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-plus mr-3 text-kai-orange"></i>
            Buat Jadwal
        </h1>
        <p class="text-gray-600">Tambah jadwal kereta api baru</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.schedules.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
    </div>
</div>

<form action="{{ route('admin.schedules.store') }}" method="POST" class="space-y-8">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Kartu Informasi Kereta -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-train mr-3"></i>
                        Informasi Kereta
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Pemilihan Rute -->
                    <div>
                        <label for="route_id" class="block text-sm font-medium text-gray-700 mb-2">
                            Rute <span class="text-red-500">*</span>
                        </label>
                        <select id="route_id" 
                                name="route_id" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('route_id') border-red-500 @enderror"
                                onchange="updateRouteInfo()"
                                required>
                            <option value="">Pilih Rute...</option>
                            @foreach($routes as $route)
                                <option value="{{ $route->id }}" 
                                        data-origin="{{ $route->originStation->code }}"
                                        data-destination="{{ $route->destinationStation->code }}"
                                        data-distance="{{ $route->distance_km }}"
                                        data-duration="{{ $route->duration_minutes }}"
                                        {{ old('route_id') == $route->id ? 'selected' : '' }}>
                                    {{ $route->originStation->code }} → {{ $route->destinationStation->code }} 
                                    ({{ $route->distance_km }}km)
                                </option>
                            @endforeach
                        </select>
                        @error('route_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Baris Detail Kereta -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="train_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kereta <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="train_name" 
                                   name="train_name" 
                                   value="{{ old('train_name') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('train_name') border-red-500 @enderror"
                                   placeholder="e.g., Argo Bromo Anggrek"
                                   required>
                            @error('train_name')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="train_number" class="block text-sm font-medium text-gray-700 mb-2">
                                Nomor Kereta <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="train_number" 
                                   name="train_number" 
                                   value="{{ old('train_number') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('train_number') border-red-500 @enderror"
                                   placeholder="e.g., KA 1"
                                   required>
                            @error('train_number')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Kelas Kereta -->
                    <div>
                        <label for="train_class" class="block text-sm font-medium text-gray-700 mb-2">
                            Kelas Kereta <span class="text-red-500">*</span>
                        </label>
                        <select id="train_class" 
                                name="train_class" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('train_class') border-red-500 @enderror"
                                required>
                            <option value="">Select Kelas Kereta...</option>
                            <option value="Eksekutif" {{ old('train_class') == 'Eksekutif' ? 'selected' : '' }}>Eksekutif</option>
                            <option value="Bisnis" {{ old('train_class') == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                            <option value="Ekonomi" {{ old('train_class') == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="Ekonomi Premium" {{ old('train_class') == 'Ekonomi Premium' ? 'selected' : '' }}>Ekonomi Premium</option>
                        </select>
                        @error('train_class')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Detail Jadwal Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-clock mr-3"></i>
                        Detail Jadwal
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Time Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-700 mb-2">
                                Waktu Keberangkatan <span class="text-red-500">*</span>
                            </label>
                            <input type="time" 
                                   id="departure_time" 
                                   name="departure_time" 
                                   value="{{ old('departure_time') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('departure_time') border-red-500 @enderror"
                                   onchange="calculateArrivalTime()"
                                   required>
                            @error('departure_time')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="arrival_time" class="block text-sm font-medium text-gray-700 mb-2">
                                Waktu Kedatangan <span class="text-red-500">*</span>
                            </label>
                            <input type="time" 
                                   id="arrival_time" 
                                   name="arrival_time" 
                                   value="{{ old('arrival_time') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('arrival_time') border-red-500 @enderror"
                                   required>
                            @error('arrival_time')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>

                    <!-- Auto-calculate arrival time button -->
                    <div class="flex items-center justify-center">
                        <button type="button" 
                                onclick="calculateArrivalTime()"
                                class="flex items-center px-4 py-2 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                            <i class="fas fa-calculator mr-2"></i>
                            Hitung Otomatis Waktu Kedatangan
                        </button>
                    </div>

                    <!-- Baris Kursi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="total_seats" class="block text-sm font-medium text-gray-700 mb-2">
                                Total Kursi <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="total_seats" 
                                   name="total_seats" 
                                   value="{{ old('total_seats') }}"
                                   min="1"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('total_seats') border-red-500 @enderror"
                                   placeholder="e.g., 200"
                                   onchange="updateTersediaSeats()"
                                   required>
                            @error('total_seats')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="available_seats" class="block text-sm font-medium text-gray-700 mb-2">
                                Kursi Tersedia <span class="text-red-500">*</span>
                            </label>
                            <input type="number" 
                                   id="available_seats" 
                                   name="available_seats" 
                                   value="{{ old('available_seats') }}"
                                   min="0"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('available_seats') border-red-500 @enderror"
                                   placeholder="e.g., 200"
                                   required>
                            @error('available_seats')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Informasi Rute -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-route mr-3"></i>
                        Informasi Rute
                    </h3>
                </div>
                
                <div class="p-6">
                    <div id="routeInfo" class="text-center py-8 bg-gray-50 rounded-lg">
                        <i class="fas fa-route text-4xl text-gray-400 mb-4"></i>
                        <p class="text-gray-600">Select route to view information</p>
                    </div>
                </div>
            </div>

            <!-- Status Jadwal -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-toggle-on mr-3"></i>
                        Status Jadwal
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-gray-900">Status Aktif</h4>
                                <p class="text-sm text-gray-600">Status operasional jadwal</p>
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
                        Buat Jadwal
                    </button>
                    
                    <button type="button" 
                            onclick="previewSchedule()"
                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        Pratinjau Jadwal
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal Pratinjau -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Pratinjau Jadwal</h3>
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
    // Update route information when route is selected
    function updateRouteInfo() {
        const routeSelect = document.getElementById('route_id');
        const routeInfo = document.getElementById('routeInfo');
        const selectedOption = routeSelect.options[routeSelect.selectedIndex];
        
        if (routeSelect.value) {
            const origin = selectedOption.getAttribute('data-origin');
            const destination = selectedOption.getAttribute('data-destination');
            const distance = selectedOption.getAttribute('data-distance');
            const duration = selectedOption.getAttribute('data-duration');
            
            const jam = Math.floor(duration / 60);
            const mins = duration % 60;
            
            routeInfo.innerHTML = `
                <div class="text-center">
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <div class="text-center">
                            <div class="w-12 h-12 bg-kai-blue rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-train text-white"></i>
                            </div>
                            <div class="font-bold text-kai-blue">${origin}</div>
                        </div>
                        <div class="flex-1">
                            <i class="fas fa-arrow-right text-2xl text-kai-orange"></i>
                        </div>
                        <div class="text-center">
                            <div class="w-12 h-12 bg-kai-orange rounded-full flex items-center justify-center mb-2">
                                <i class="fas fa-map-marker-alt text-white"></i>
                            </div>
                            <div class="font-bold text-kai-orange">${destination}</div>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="text-gray-600">Jarak:</span>
                            <span class="font-medium ml-1">${distance} km</span>
                        </div>
                        <div>
                            <span class="text-gray-600">Durasi:</span>
                            <span class="font-medium ml-1">${hours}h ${mins}m</span>
                        </div>
                    </div>
                </div>
            `;
        } else {
            routeInfo.innerHTML = `
                <i class="fas fa-route text-4xl text-gray-400 mb-4"></i>
                <p class="text-gray-600">Select route to view information</p>
            `;
        }
    }

    // Calculate arrival time based on departure time and route duration
    function calculateArrivalTime() {
        const routeSelect = document.getElementById('route_id');
        const departureTime = document.getElementById('departure_time').value;
        const arrivalTimeInput = document.getElementById('arrival_time');
        
        if (routeSelect.value && departureTime) {
            const selectedOption = routeSelect.options[routeSelect.selectedIndex];
            const duration = parseInt(selectedOption.getAttribute('data-duration'));
            
            if (duration) {
                const [hours, menit] = departureTime.split(':').map(Number);
                const departureMinutes = jam * 60 + menit;
                const arrivalMinutes = departureMinutes + duration;
                
                const arrivalHours = Math.floor(arrivalMinutes / 60) % 24;
                const arrivalMins = arrivalMinutes % 60;
                
                const formattedTime = `${arrivalHours.toString().padStart(2, '0')}:${arrivalMins.toString().padStart(2, '0')}`;
                arrivalTimeInput.value = formattedTime;
            }
        }
    }

    // Update available seats to match total seats
    function updateTersediaSeats() {
        const totalSeats = document.getElementById('total_seats').value;
        const availableSeats = document.getElementById('available_seats');
        
        if (totalSeats && !availableSeats.value) {
            availableSeats.value = totalSeats;
        }
    }

    // Preview schedule
    function previewSchedule() {
        const routeSelect = document.getElementById('route_id');
        const trainName = document.getElementById('train_name').value;
        const trainNumber = document.getElementById('train_number').value;
        const trainClass = document.getElementById('train_class').value;
        const departureTime = document.getElementById('departure_time').value;
        const arrivalTime = document.getElementById('arrival_time').value;
        const totalSeats = document.getElementById('total_seats').value;
        const availableSeats = document.getElementById('available_seats').value;
        const isActive = document.querySelector('input[name="is_active"]').checked;
        
        const selectedOption = routeSelect.options[routeSelect.selectedIndex];
        
        if (!routeSelect.value) {
            alert('Please select a route first');
            return;
        }
        
        const origin = selectedOption.getAttribute('data-origin');
        const destination = selectedOption.getAttribute('data-destination');
        const distance = selectedOption.getAttribute('data-distance');
        const duration = selectedOption.getAttribute('data-duration');
        
        const jam = Math.floor(duration / 60);
        const mins = duration % 60;
        
        let previewHTML = `
            <div class="text-center">
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">${trainName || 'Nama Kereta'}</h2>
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-kai-blue text-white">
                            ${trainNumber || 'Nomor Kereta'}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-kai-orange text-white">
                            ${trainClass || 'Class'}
                        </span>
                    </div>
                </div>
                
                <div class="flex items-center justify-center space-x-8 mb-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-kai-blue rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-train text-white text-2xl"></i>
                        </div>
                        <div class="font-bold text-kai-blue text-lg">${origin || 'ORIGIN'}</div>
                        <div class="text-2xl font-bold text-green-600 mt-2">${departureTime || '--:--'}</div>
                        <div class="text-sm text-gray-600">Departure</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full border-t-2 border-dashed border-kai-orange relative mb-2">
                            <i class="fas fa-arrow-right text-2xl text-kai-orange absolute -top-3 left-1/2 transform -translate-x-1/2 bg-white px-2"></i>
                        </div>
                        <div class="text-sm text-gray-600">${distance || '0'} km • ${hours}h ${mins}m</div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-kai-orange rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                        <div class="font-bold text-kai-orange text-lg">${destination || 'DEST'}</div>
                        <div class="text-2xl font-bold text-red-600 mt-2">${arrivalTime || '--:--'}</div>
                        <div class="text-sm text-gray-600">Arrival</div>
                    </div>
                </div>
                
                <div class="grid grid-cols-3 gap-6 mb-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Total Kursi</h4>
                        <p class="text-2xl font-bold text-kai-blue">${totalSeats || '0'}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Tersedia</h4>
                        <p class="text-2xl font-bold text-green-600">${availableSeats || '0'}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-medium text-gray-700 mb-2">Occupancy</h4>
                        <p class="text-2xl font-bold text-kai-orange">${totalSeats && availableSeats ? Math.round(((totalSeats - availableSeats) / totalSeats) * 100) : 0}%</p>
                    </div>
                </div>
                
                <div class="flex items-center justify-center">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium ${isActive ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'}">
                        <i class="fas fa-${isActive ? 'check' : 'times'} mr-2"></i>
                        ${isActive ? 'Active Schedule' : 'Inactive Schedule'}
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
        const totalSeats = parseInt(document.getElementById('total_seats').value);
        const availableSeats = parseInt(document.getElementById('available_seats').value);
        
        if (availableSeats > totalSeats) {
            e.preventDefault();
            alert('Tersedia seats cannot exceed total seats.');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Schedule...';
        submitBtn.disabled = true;
    });

    // Initialize displays on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRouteInfo();
    });
</script>
@endpush
