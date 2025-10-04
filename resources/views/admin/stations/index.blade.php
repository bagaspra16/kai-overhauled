@extends('admin.layouts.app')

@section('title', 'Manajemen Stasiun')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-map-marker-alt mr-3 text-kai-orange"></i>
            Manajemen Stasiun
        </h1>
        <p class="text-gray-600">Kelola stasiun kereta api dan lokasi</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <button class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-download mr-2"></i>
            Ekspor
        </button>
        <a href="{{ route('admin.stations.create') }}" 
           class="flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            Tambah Stasiun Baru
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Stasiun</p>
                <p class="text-2xl font-bold text-kai-blue">{{ $stations->total() }}</p>
            </div>
            <div class="bg-kai-blue/10 p-3 rounded-full">
                <i class="fas fa-map-marker-alt text-kai-blue text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Stasiun Aktif</p>
                <p class="text-2xl font-bold text-green-500">{{ $stations->where('is_active', true)->count() }}</p>
            </div>
            <div class="bg-green-500/10 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-orange">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Kota</p>
                <p class="text-2xl font-bold text-kai-orange">{{ $stations->unique('city')->count() }}</p>
            </div>
            <div class="bg-kai-orange/10 p-3 rounded-full">
                <i class="fas fa-city text-kai-orange text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Provinsi</p>
                <p class="text-2xl font-bold text-purple-500">{{ $stations->unique('province')->count() }}</p>
            </div>
            <div class="bg-purple-500/10 p-3 rounded-full">
                <i class="fas fa-map text-purple-500 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Semua Stasiun</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari stasiun..." 
                           class="bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
                           id="searchInput">
                    <i class="fas fa-search absolute right-3 top-3 text-white/70"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        @if($stations->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Stasiun</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Lokasi</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Koordinat</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-center py-4 px-4 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($stations as $station)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-train text-kai-blue text-lg"></i>
                                    </div>
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-bold bg-kai-blue text-white">
                                                {{ $station->code }}
                                            </span>
                                        </div>
                                        <h4 class="font-semibold text-gray-900 mt-1">{{ $station->name }}</h4>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="space-y-1">
                                    <div class="flex items-center">
                                        <i class="fas fa-city text-gray-400 mr-2"></i>
                                        <span class="font-medium text-gray-700">{{ $station->city }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-map text-gray-400 mr-2"></i>
                                        <span class="text-sm text-gray-600">{{ $station->province }}</span>
                                    </div>
                            </td>
                            <td class="py-4 px-4">
                                @if($station->latitude && $station->longitude)
                                    <div class="space-y-1">
                                        <div class="text-sm">
                                            <span class="text-gray-600">Lat:</span>
                                            <span class="font-mono text-kai-blue">{{ number_format($station->latitude, 6) }}</span>
                                        </div>
                                        <div class="text-sm">
                                            <span class="text-gray-600">Lng:</span>
                                            <span class="font-mono text-kai-orange">{{ number_format($station->longitude, 6) }}</span>
                                        </div>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">Tidak tersedia</span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-check mr-1"></i>
                                    Aktif
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.stations.show', $station->id) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                       title="Lihat Stasiun">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.stations.edit', $station->id) }}" 
                                       class="p-2 text-kai-blue hover:bg-kai-blue/10 rounded-lg transition-colors duration-200"
                                       title="Edit Stasiun">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                            title="Hapus Stasiun"
                                            onclick="confirmDelete('{{ route('admin.stations.destroy', $station->id) }}', 'Delete this station?')">
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
                @foreach($stations as $station)
                <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-train text-kai-blue text-lg"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="inline-flex items-center px-2 py-1 rounded-md text-xs font-bold bg-kai-blue text-white">
                                    {{ $station->code }}
                                </span>
                            </div>
                            <h4 class="font-semibold text-gray-900 mb-1">{{ $station->name }}</h4>
                            <div class="space-y-1 mb-3">
                        <div class="text-sm">
                            <span class="text-gray-600">Kota:</span>
                            <span class="font-medium ml-1">{{ $station->city }}</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-600">Provinsi:</span>
                            <span class="font-medium ml-1">{{ $station->province }}</span>
                        </div>
                                @if($station->latitude && $station->longitude)
                                    <div class="text-sm">
                                        <span class="text-gray-600">Koordinat:</span>
                                        <span class="font-mono text-xs">{{ number_format($station->latitude, 4) }}, {{ number_format($station->longitude, 4) }}</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>
                                        Aktif
                                    </span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.stations.show', $station->id) }}" 
                                       class="p-1 text-blue-600">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.stations.edit', $station->id) }}" 
                                       class="p-1 text-kai-blue">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-1 text-red-600"
                                            onclick="confirmDelete('{{ route('admin.stations.destroy', $station->id) }}', 'Delete this station?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $stations->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-map-marker-alt text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Stasiun Ditemukan</h3>
                <p class="text-gray-600 mb-8">Mulai dengan membuat stasiun pertama untuk membangun jaringan kereta api Anda.</p>
                <a href="{{ route('admin.stations.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Stasiun Pertama
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
