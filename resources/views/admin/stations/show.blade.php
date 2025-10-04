@extends('admin.layouts.app')

@section('title', 'Lihat Stasiun')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-eye mr-3 text-kai-orange"></i>
            Lihat Stasiun
        </h1>
        <p class="text-gray-600">Detail dan informasi stasiun</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.stations.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
        <a href="{{ route('admin.stations.edit', $station->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-edit mr-2"></i>
            Edit Stasiun
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Header Stasiun -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-8 py-8 text-center">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-train text-white text-4xl"></i>
                </div>
                <div class="inline-flex items-center px-4 py-2 rounded-full text-lg font-bold bg-white text-kai-blue mb-4">
                    {{ $station->code }}
                </div>
                <h1 class="text-3xl font-bold mb-2">{{ $station->name }}</h1>
                <p class="text-white/90">{{ $station->city }}, {{ $station->province }}</p>
            </div>
        </div>

        <!-- Informasi Lokasi -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-map-marker-alt mr-3"></i>
                    Informasi Lokasi
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-city text-kai-blue text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">City</p>
                                <p class="font-semibold text-gray-900">{{ $station->city }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-kai-orange/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-map text-kai-orange text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Province</p>
                                <p class="font-semibold text-gray-900">{{ $station->province }}</p>
                            </div>
                        </div>
                    </div>
                    
                    @if($station->latitude && $station->longitude)
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-green-500/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-crosshairs text-green-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Lintang</p>
                                <p class="font-mono text-gray-900">{{ number_format($station->latitude, 6) }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-crosshairs text-purple-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Bujur</p>
                                <p class="font-mono text-gray-900">{{ number_format($station->longitude, 6) }}</p>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                @if($station->latitude && $station->longitude)
                <div class="mt-6">
                    <button onclick="openMap()" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-map-marked-alt mr-2"></i>
                        View on Map
                    </button>
                </div>
                @endif
            </div>
        </div>

        <!-- Informasi Rute -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-route mr-3"></i>
                    Connected Rute
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center py-8 bg-gray-50 rounded-lg">
                    <i class="fas fa-route text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Route connections will appear here</p>
                    <a href="{{ route('admin.routes.index') }}" 
                       class="inline-flex items-center mt-3 text-kai-blue hover:text-kai-blue-light transition-colors duration-300">
                        <i class="fas fa-arrow-right mr-2"></i>
                        View All Rute
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Detail Stasiun -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Detail Stasiun
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Kode Stasiun</span>
                    <span class="font-bold text-kai-blue">{{ $station->code }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Status</span>
                    @if($station->is_active)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>
                            Active
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                            <i class="fas fa-times mr-1"></i>
                            Inactive
                        </span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Rute</span>
                    <span class="font-medium">0 connections</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Created</span>
                    <span class="font-medium">{{ $station->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Updated</span>
                    <span class="font-medium">{{ $station->updated_at->format('M d, Y') }}</span>
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
                <a href="{{ route('admin.stations.edit', $station->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Stasiun
                </a>
                
                @if($station->latitude && $station->longitude)
                <button onclick="openMap()" 
                        class="flex items-center w-full p-3 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                    <i class="fas fa-map-marked-alt mr-3"></i>
                    Lihat di Peta
                </button>
                @endif
                
                <button onclick="printStation()" 
                        class="flex items-center w-full p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                    <i class="fas fa-print mr-3"></i>
                    Cetak Detail
                </button>
                
                <button onclick="confirmDelete('{{ route('admin.stations.destroy', $station->id) }}', 'Delete this station?')" 
                        class="flex items-center w-full p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-trash mr-3"></i>
                    Hapus Stasiun
                </button>
            </div>
        </div>

        <!-- Statistik Stasiun -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Statistik
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="text-center p-4 bg-kai-blue/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-blue">0</div>
                    <div class="text-sm text-gray-600">Departing Rute</div>
                </div>
                
                <div class="text-center p-4 bg-kai-orange/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-orange">0</div>
                    <div class="text-sm text-gray-600">Arriving Rute</div>
                </div>
                
                <div class="text-center p-4 bg-green-500/5 rounded-lg">
                    <div class="text-2xl font-bold text-green-500">0</div>
                    <div class="text-sm text-gray-600">Total Connections</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Open map
    function openMap() {
        @if($station->latitude && $station->longitude)
        const lat = {{ $station->latitude }};
        const lng = {{ $station->longitude }};
        const url = `https://www.google.com/maps?q=${lat},${lng}&z=15`;
        window.open(url, '_blank');
        @endif
    }

    // Print station
    function printStation() {
        window.print();
    }
</script>
@endpush
