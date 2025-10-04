@extends('admin.layouts.app')

@section('title', 'Edit Jadwal')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-edit mr-3 text-kai-orange"></i>
            Edit Jadwal
        </h1>
        <p class="text-gray-600">Perbarui informasi jadwal kereta</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.schedules.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
        <a href="{{ route('admin.schedules.show', $schedule->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-eye mr-2"></i>
            Lihat Jadwal
        </a>
    </div>
</div>

<form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')
    
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
                                        {{ old('route_id', $schedule->route_id) == $route->id ? 'selected' : '' }}
                                        data-origin="{{ $route->originStation->code }}"
                                        data-destination="{{ $route->destinationStation->code }}"
                                        data-distance="{{ $route->distance_km }}"
                                        data-duration="{{ $route->duration_minutes }}">
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
                                   value="{{ old('train_name', $schedule->train_name) }}"
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
                                   value="{{ old('train_number', $schedule->train_number) }}"
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
                            <option value="Eksekutif" {{ old('train_class', $schedule->train_class) == 'Eksekutif' ? 'selected' : '' }}>Eksekutif</option>
                            <option value="Bisnis" {{ old('train_class', $schedule->train_class) == 'Bisnis' ? 'selected' : '' }}>Bisnis</option>
                            <option value="Ekonomi" {{ old('train_class', $schedule->train_class) == 'Ekonomi' ? 'selected' : '' }}>Ekonomi</option>
                            <option value="Ekonomi Premium" {{ old('train_class', $schedule->train_class) == 'Ekonomi Premium' ? 'selected' : '' }}>Ekonomi Premium</option>
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
                                   value="{{ old('departure_time', $schedule->formatted_departure_time ?? '') }}"
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
                                   value="{{ old('arrival_time', $schedule->formatted_arrival_time ?? '') }}"
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
                                   value="{{ old('total_seats', $schedule->total_seats) }}"
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
                                   value="{{ old('available_seats', $schedule->available_seats) }}"
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
                            <p class="mt-1 text-sm text-gray-500">Current bookings: {{ $schedule->total_seats - $schedule->available_seats }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Info Jadwal Saat Ini -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Info Saat Ini
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">ID Jadwal</span>
                        <span class="font-mono text-kai-blue">#{{ $schedule->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Rute Saat Ini</span>
                        <span class="font-medium">{{ $schedule->route->originStation->code }} → {{ $schedule->route->destinationStation->code }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Kereta Saat Ini</span>
                        <span class="font-medium">{{ $schedule->train_name }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Kelas Saat Ini</span>
                        <span class="font-medium">{{ $schedule->train_class }}</span>
                    </div>
                </div>
            </div>

            <!-- Informasi Rute -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-route mr-3"></i>
                        Informasi Rute
                    </h3>
                </div>
                
                <div class="p-6">
                    <div id="routeInfo">
                        <div class="text-center">
                            <div class="flex items-center justify-center space-x-4 mb-4">
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-kai-blue rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-train text-white"></i>
                                    </div>
                                    <div class="font-bold text-kai-blue">{{ $schedule->route->originStation->code }}</div>
                                </div>
                                <div class="flex-1">
                                    <i class="fas fa-arrow-right text-2xl text-kai-orange"></i>
                                </div>
                                <div class="text-center">
                                    <div class="w-12 h-12 bg-kai-orange rounded-full flex items-center justify-center mb-2">
                                        <i class="fas fa-map-marker-alt text-white"></i>
                                    </div>
                                    <div class="font-bold text-kai-orange">{{ $schedule->route->destinationStation->code }}</div>
                                </div>
                            </div>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-600">Jarak:</span>
                                    <span class="font-medium ml-1">{{ $schedule->route->distance_km }} km</span>
                                </div>
                                <div>
                                    <span class="text-gray-600">Durasi:</span>
                                    <span class="font-medium ml-1">{{ floor($schedule->route->duration_minutes / 60) }}h {{ $schedule->route->duration_minutes % 60 }}m</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Seat Occupancy -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-chart-pie mr-3"></i>
                        Okupansi Kursi
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Kursi Terpesan</span>
                        <span class="font-bold text-red-500">{{ $schedule->total_seats - $schedule->available_seats }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Kursi Tersedia</span>
                        <span class="font-bold text-green-500">{{ $schedule->available_seats }}</span>
                    </div>
                    
                    <!-- Occupancy Bar -->
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-sm text-gray-600">Occupancy Rate</span>
                            <span class="text-sm font-medium text-gray-900">{{ $schedule->total_seats > 0 ? number_format(($schedule->total_seats - $schedule->available_seats) / $schedule->total_seats * 100, 1) : 0 }}%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-3">
                            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light h-3 rounded-full transition-all duration-300" 
                                 style="width: {{ $schedule->total_seats > 0 ? ($schedule->total_seats - $schedule->available_seats) / $schedule->total_seats * 100 : 0 }}%"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Jadwal -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-toggle-on mr-3"></i>
                        Status Jadwal
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Status Aktif</h4>
                            <p class="text-sm text-gray-600">Status operasional jadwal</p>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $schedule->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-kai-blue/20 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kai-blue"></div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Perbarui Jadwal
                    </button>
                    
                    <a href="{{ route('admin.schedules.index') }}" 
                       class="w-full bg-gray-500 text-white py-3 px-6 rounded-lg font-medium hover:bg-gray-600 transition-colors duration-300 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Batal
                    </a>
                    
                    <button type="button" 
                            onclick="confirmDelete('{{ route('admin.schedules.destroy', $schedule->id) }}', 'Hapus jadwal ini?')"
                            class="w-full bg-red-500 text-white py-3 px-6 rounded-lg font-medium hover:bg-red-600 transition-colors duration-300 flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus Jadwal
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
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

    // Update available seats validation
    function updateTersediaSeats() {
        const totalSeats = parseInt(document.getElementById('total_seats').value);
        const availableSeatsInput = document.getElementById('available_seats');
        const currentTersedia = parseInt(availableSeatsInput.value);
        
        if (currentTersedia > totalSeats) {
            availableSeatsInput.value = totalSeats;
        }
        
        availableSeatsInput.max = totalSeats;
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
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Memperbarui Jadwal...';
        submitBtn.disabled = true;
    });

    // Initialize displays on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateRouteInfo();
        updateTersediaSeats();
    });
</script>
@endpush
