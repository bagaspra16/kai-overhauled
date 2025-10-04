@extends('admin.layouts.app')

@section('title', 'Lihat Rute')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-eye mr-3 text-kai-orange"></i>
            Lihat Rute
        </h1>
        <p class="text-gray-600">Route connection details</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.routes.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.routes.edit', $route->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-edit mr-2"></i>
            Edit Rute
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Route Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-8 py-8">
                <div class="flex items-center justify-center space-x-8 mb-6">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-train text-white text-3xl"></i>
                        </div>
                        <div class="font-bold text-white text-2xl">{{ $route->originStation->code ?? 'N/A' }}</div>
                        <div class="text-white/90">{{ $route->originStation->name ?? 'N/A' }}</div>
                    </div>
                    <div class="flex-1 flex items-center justify-center">
                        <div class="w-full border-t-2 border-dashed border-white/50 relative">
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-20 h-20 bg-white/20 rounded-full flex items-center justify-center mb-4">
                            <i class="fas fa-map-marker-alt text-white text-3xl"></i>
                        </div>
                        <div class="font-bold text-white text-2xl">{{ $route->destinationStation->code ?? 'N/A' }}</div>
                        <div class="text-white/90">{{ $route->destinationStation->name ?? 'N/A' }}</div>
                    </div>
                </div>
                <div class="text-center">
                    <h1 class="text-2xl font-bold mb-2">{{ $route->originStation->name ?? 'N/A' }} → {{ $route->destinationStation->name ?? 'N/A' }}</h1>
                    <p class="text-white/90">{{ $route->distance_km }} km • {{ $route->formatted_duration ?? 'N/A' }}</p>
                </div>
            </div>
        </div>

        <!-- Detail Rute -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Informasi Rute
                </h3>
            </div>
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-ruler-horizontal text-kai-blue text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Jarak</p>
                                <p class="font-semibold text-gray-900">{{ $route->distance_km }} km</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-kai-orange/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-clock text-kai-orange text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Durasi</p>
                                <p class="font-semibold text-gray-900">{{ $route->formatted_duration ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-4">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-green-500/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-money-bill-wave text-green-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Base Price</p>
                                <p class="font-semibold text-gray-900">Rp {{ number_format($route->base_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div class="w-12 h-12 bg-purple-500/10 rounded-full flex items-center justify-center mr-4">
                                <i class="fas fa-child text-purple-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Harga Bayi</p>
                                <p class="font-semibold text-gray-900">Rp {{ number_format($route->infant_price, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Jadwal -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-calendar-alt mr-3"></i>
                    Active Jadwal
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center py-8 bg-gray-50 rounded-lg">
                    <i class="fas fa-calendar-alt text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Active schedules for this route will appear here</p>
                    <a href="{{ route('admin.schedules.create') }}" 
                       class="inline-flex items-center mt-3 text-kai-blue hover:text-kai-blue-light transition-colors duration-300">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Jadwal
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Route Status -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Route Status
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Status</span>
                    @if($route->is_active)
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
                    <span class="text-gray-600">Jadwal</span>
                    <span class="font-medium">0 active</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Created</span>
                    <span class="font-medium">{{ $route->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Updated</span>
                    <span class="font-medium">{{ $route->updated_at->format('M d, Y') }}</span>
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
                <a href="{{ route('admin.routes.edit', $route->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Rute
                </a>
                
                <a href="{{ route('admin.schedules.create') }}?route_id={{ $route->id }}" 
                   class="flex items-center w-full p-3 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                    <i class="fas fa-plus mr-3"></i>
                    Tambah Jadwal
                </a>
                
                <button onclick="printRoute()" 
                        class="flex items-center w-full p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                    <i class="fas fa-print mr-3"></i>
                    Print Details
                </button>
                
                <button onclick="confirmDelete('{{ route('admin.routes.destroy', $route->id) }}', 'Delete this route?')" 
                        class="flex items-center w-full p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-trash mr-3"></i>
                    Delete Route
                </button>
            </div>
        </div>

        <!-- Route Statistik -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Statistik
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="text-center p-4 bg-kai-blue/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-blue">{{ $route->distance_km }}</div>
                    <div class="text-sm text-gray-600">Kilometers</div>
                </div>
                
                <div class="text-center p-4 bg-kai-orange/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-orange">{{ $route->duration_minutes }}</div>
                    <div class="text-sm text-gray-600">Minutes</div>
                </div>
                
                <div class="text-center p-4 bg-green-500/5 rounded-lg">
                    <div class="text-2xl font-bold text-green-500">0</div>
                    <div class="text-sm text-gray-600">Jadwal</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Print route
    function printRoute() {
        window.print();
    }
</script>
@endpush
