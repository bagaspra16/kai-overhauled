@extends('admin.layouts.app')

@section('title', 'Manajemen Rute')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-route mr-3 text-kai-orange"></i>
            Manajemen Rute
        </h1>
        <p class="text-gray-600">Kelola rute kereta api dan koneksi</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.routes.create') }}" 
           class="flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            Tambah Rute Baru
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Rute</p>
                <p class="text-2xl font-bold text-kai-blue">{{ $routes->total() }}</p>
            </div>
            <div class="bg-kai-blue/10 p-3 rounded-full">
                <i class="fas fa-route text-kai-blue text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Active Rute</p>
                <p class="text-2xl font-bold text-green-500">{{ $routes->where('is_active', true)->count() }}</p>
            </div>
            <div class="bg-green-500/10 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-orange">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Rata-rata Jarak</p>
                <p class="text-2xl font-bold text-kai-orange">{{ number_format($routes->avg('distance_km'), 0) }} km</p>
            </div>
            <div class="bg-kai-orange/10 p-3 rounded-full">
                <i class="fas fa-ruler text-kai-orange text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Rata-rata Harga</p>
                <p class="text-2xl font-bold text-purple-500">Rp {{ number_format($routes->avg('base_price'), 0, ',', '.') }}</p>
            </div>
            <div class="bg-purple-500/10 p-3 rounded-full">
                <i class="fas fa-money-bill-wave text-purple-500 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Semua Rute</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari rute..." 
                           class="bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
                           id="searchInput">
                    <i class="fas fa-search absolute right-3 top-3 text-white/70"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        @if($routes->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Rute</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Jarak</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Durasi</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Harga</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-center py-4 px-4 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($routes as $route)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0">
                                        <div class="w-10 h-10 bg-kai-blue/10 rounded-full flex items-center justify-center">
                                            <i class="fas fa-route text-kai-blue"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="font-semibold text-kai-blue">{{ $route->originStation->code ?? 'N/A' }}</span>
                                            <i class="fas fa-arrow-right text-gray-400"></i>
                                            <span class="font-semibold text-kai-orange">{{ $route->destinationStation->code ?? 'N/A' }}</span>
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            {{ $route->originStation->name ?? 'N/A' }} → {{ $route->destinationStation->name ?? 'N/A' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <i class="fas fa-ruler-horizontal text-gray-400 mr-2"></i>
                                    <span class="font-medium">{{ $route->distance_km }} km</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <i class="fas fa-clock text-gray-400 mr-2"></i>
                                    <span class="font-medium">{{ $route->formatted_duration ?? 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="space-y-1">
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 mr-2">Dasar:</span>
                                        <span class="font-semibold text-kai-blue">Rp {{ number_format($route->base_price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <span class="text-sm text-gray-600 mr-2">Bayi:</span>
                                        <span class="font-semibold text-green-600">Rp {{ number_format($route->infant_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                @if($route->is_active)
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
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.routes.show', $route->id) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                       title="Lihat Rute">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.routes.edit', $route->id) }}" 
                                       class="p-2 text-kai-blue hover:bg-kai-blue/10 rounded-lg transition-colors duration-200"
                                       title="Edit Rute">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                            title="Delete Route"
                                            onclick="confirmDelete('{{ route('admin.routes.destroy', $route->id) }}', 'Delete this route?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mobile Card View -->
            <div class="lg:hidden space-y-4">
                @foreach($routes as $route)
                <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all duration-300">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-kai-blue/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-route text-kai-blue"></i>
                            </div>
                            <div>
                                <div class="flex items-center space-x-2">
                                    <span class="font-semibold text-kai-blue">{{ $route->originStation->code }}</span>
                                    <i class="fas fa-arrow-right text-gray-400 text-sm"></i>
                                    <span class="font-semibold text-kai-orange">{{ $route->destinationStation->code }}</span>
                                </div>
                                <div class="text-sm text-gray-600">
                                    {{ $route->originStation->name }} → {{ $route->destinationStation->name }}
                                </div>
                            </div>
                        </div>
                        @if($route->is_active)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>
                                Inactive
                            </span>
                        @endif
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div class="text-sm">
                            <span class="text-gray-600">Jarak:</span>
                            <span class="font-medium ml-1">{{ $route->distance_km }} km</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-600">Durasi:</span>
                            <span class="font-medium ml-1">{{ $route->formatted_duration ?? 'N/A' }}</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-600">Harga Dasar:</span>
                            <span class="font-medium ml-1 text-kai-blue">Rp {{ number_format($route->base_price, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-600">Harga Bayi:</span>
                            <span class="font-medium ml-1 text-green-600">Rp {{ number_format($route->infant_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.routes.show', $route->id) }}" 
                           class="p-1 text-blue-600">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.routes.edit', $route->id) }}" 
                           class="p-1 text-kai-blue">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" 
                                class="p-1 text-red-600"
                                onclick="confirmDelete('{{ route('admin.routes.destroy', $route->id) }}', 'Delete this route?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $routes->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-route text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Rute Ditemukan</h3>
                <p class="text-gray-600 mb-8">Mulai dengan membuat rute pertama untuk menghubungkan stasiun.</p>
                <a href="{{ route('admin.routes.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Rute Pertama
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Cari functionality
    document.getElementById('searchInput').addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase();
        const rows = document.querySelectorAll('tbody tr, .lg\\:hidden > div');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    });

    // Add loading states to action buttons
    document.querySelectorAll('a[href*="show"], a[href*="edit"]').forEach(link => {
        link.addEventListener('click', function() {
            const icon = this.querySelector('i');
            icon.className = 'fas fa-spinner fa-spin';
        });
    });
</script>
@endpush
