@extends('admin.layouts.app')

@section('title', 'Lihat Jadwal')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-eye mr-3 text-kai-orange"></i>
            Lihat Jadwal
        </h1>
        <p class="text-gray-600">Detail dan informasi jadwal kereta</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.schedules.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
        <a href="{{ route('admin.schedules.edit', $schedule->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-edit mr-2"></i>
            Edit Jadwal
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Header Jadwal -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-8 py-8">
                <div class="text-center mb-6">
                    <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-train text-white text-3xl"></i>
                    </div>
                    <h1 class="text-3xl font-bold mb-2">{{ $schedule->train_name }}</h1>
                    <div class="flex items-center justify-center space-x-4 mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white">
                            {{ $schedule->train_number }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-white/20 text-white">
                            {{ $schedule->train_class }}
                        </span>
                    </div>
                </div>
                
                <div class="flex items-center justify-center space-x-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-train text-white text-2xl"></i>
                        </div>
                        <div class="font-bold text-white text-lg">{{ $schedule->route->originStation->code }}</div>
                        <div class="text-white/90 text-sm">{{ $schedule->route->originStation->name }}</div>
                        <div class="text-2xl font-bold text-green-300 mt-2">{{ $schedule->formatted_departure_time ?? 'N/A' }}</div>
                        <div class="text-white/80 text-sm">Keberangkatan</div>
                    </div>
                    <div class="flex-1 flex flex-col items-center">
                        <div class="w-full border-t-2 border-dashed border-white/50 relative mb-2">
                        </div>
                        <div class="text-white/90 text-sm">{{ $schedule->route->distance_km }} km • {{ $schedule->formatted_duration }}</div>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mb-3">
                            <i class="fas fa-map-marker-alt text-white text-2xl"></i>
                        </div>
                        <div class="font-bold text-white text-lg">{{ $schedule->route->destinationStation->code }}</div>
                        <div class="text-white/90 text-sm">{{ $schedule->route->destinationStation->name }}</div>
                        <div class="text-2xl font-bold text-red-300 mt-2">{{ $schedule->formatted_arrival_time ?? 'N/A' }}</div>
                        <div class="text-white/80 text-sm">Kedatangan</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Informasi Kereta -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-train mr-3"></i>
                    Informasi Kereta
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-id-badge text-kai-blue text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nama Kereta</p>
                                <p class="font-semibold text-gray-900">{{ $schedule->train_name }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-kai-orange/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-hashtag text-kai-orange text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Nomor Kereta</p>
                                <p class="font-semibold text-gray-900">{{ $schedule->train_number }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-green-500/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-star text-green-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Kelas Kereta</p>
                                <p class="font-semibold text-gray-900">{{ $schedule->train_class }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-purple-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Journey Time</p>
                                <p class="font-semibold text-gray-900">{{ $schedule->formatted_duration }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Seat Information -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-chair mr-3"></i>
                    Informasi Kursi
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="text-center p-6 bg-kai-blue/5 rounded-lg">
                        <div class="w-16 h-16 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chair text-kai-blue text-2xl"></i>
                        </div>
                        <div class="text-3xl font-bold text-kai-blue mb-2">{{ $schedule->total_seats }}</div>
                        <div class="text-gray-600">Total Kursi</div>
                    </div>
                    
                    <div class="text-center p-6 bg-green-500/5 rounded-lg">
                        <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                        </div>
                        <div class="text-3xl font-bold text-green-500 mb-2">{{ $schedule->available_seats }}</div>
                        <div class="text-gray-600">Tersedia</div>
                    </div>
                    
                    <div class="text-center p-6 bg-red-500/5 rounded-lg">
                        <div class="w-16 h-16 bg-red-500/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-red-500 text-2xl"></i>
                        </div>
                        <div class="text-3xl font-bold text-red-500 mb-2">{{ $schedule->total_seats - $schedule->available_seats }}</div>
                        <div class="text-gray-600">Terisi</div>
                    </div>
                </div>
                
                <!-- Occupancy Bar -->
                <div class="mb-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-gray-600">Banyaknya kursi terisi</span>
                        <span class="text-sm font-medium text-gray-900">{{ number_format(($schedule->total_seats - $schedule->available_seats) / $schedule->total_seats * 100, 1) }}%</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3">
                        <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light h-3 rounded-full transition-all duration-300" 
                             style="width: {{ ($schedule->total_seats - $schedule->available_seats) / $schedule->total_seats * 100 }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Status Jadwal -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Status Jadwal
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Status</span>
                    @if($schedule->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>
                            Aktif
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times mr-1"></i>
                            Tidak Aktif
                        </span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Route</span>
                    <span class="font-medium">{{ $schedule->route->originStation->code }} → {{ $schedule->route->destinationStation->code }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Dibuat</span>
                    <span class="font-medium">{{ $schedule->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Diperbarui</span>
                    <span class="font-medium">{{ $schedule->updated_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-bolt mr-3"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.schedules.edit', $schedule->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Jadwal
                </a>
                
                <a href="{{ route('admin.routes.show', $schedule->route->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                    <i class="fas fa-route mr-3"></i>
                    Lihat Rute
                </a>
                
                <button onclick="printSchedule()" 
                        class="flex items-center w-full p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                    <i class="fas fa-print mr-3"></i>
                    Cetak Jadwal
                </button>
                
                <button onclick="confirmDelete('{{ route('admin.schedules.destroy', $schedule->id) }}', 'Delete this schedule?')" 
                        class="flex items-center w-full p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-trash mr-3"></i>
                    Hapus Jadwal
                </button>
            </div>
        </div>

        <!-- Informasi Rute -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-route mr-3"></i>
                    Detail Rute
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="text-center p-4 bg-kai-blue/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-blue">{{ $schedule->route->distance_km }}</div>
                    <div class="text-sm text-gray-600">Kilometer</div>
                </div>
                
                <div class="text-center p-4 bg-kai-orange/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-orange">{{ $schedule->route->duration_minutes }}</div>
                    <div class="text-sm text-gray-600">Menit</div>
                </div>
                
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Harga Dasar:</span>
                        <span class="font-medium">Rp {{ number_format($schedule->route->base_price, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="text-gray-600">Harga Bayi:</span>
                        <span class="font-medium">Rp {{ number_format($schedule->route->infant_price, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Print schedule
    function printSchedule() {
        window.print();
    }
</script>
@endpush
