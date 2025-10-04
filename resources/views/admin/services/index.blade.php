@extends('admin.layouts.app')

@section('title', 'Manajemen Layanan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-cogs mr-3 text-kai-orange"></i>
            Manajemen Layanan
        </h1>
        <p class="text-gray-600">Kelola layanan perusahaan dan penawaran</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <button class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-download mr-2"></i>
            Ekspor
        </button>
        <a href="{{ route('admin.services.create') }}" 
           class="flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            Tambah Layanan Baru
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Layanan</p>
                <p class="text-2xl font-bold text-kai-blue">{{ $services->total() }}</p>
            </div>
            <div class="bg-kai-blue/10 p-3 rounded-full">
                <i class="fas fa-cogs text-kai-blue text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Dengan Gambar</p>
                <p class="text-2xl font-bold text-green-500">{{ $services->whereNotNull('gambar')->count() }}</p>
            </div>
            <div class="bg-green-500/10 p-3 rounded-full">
                <i class="fas fa-image text-green-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-orange">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Dengan Ikon</p>
                <p class="text-2xl font-bold text-kai-orange">{{ $services->whereNotNull('icon')->count() }}</p>
            </div>
            <div class="bg-kai-orange/10 p-3 rounded-full">
                <i class="fas fa-icons text-kai-orange text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Terbaru</p>
                <p class="text-2xl font-bold text-purple-500">{{ $services->where('created_at', '>=', now()->subWeek())->count() }}</p>
            </div>
            <div class="bg-purple-500/10 p-3 rounded-full">
                <i class="fas fa-clock text-purple-500 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Semua Layanan</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari layanan..." 
                           class="bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
                           id="searchInput">
                    <i class="fas fa-search absolute right-3 top-3 text-white/70"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        @if($services->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Layanan</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Deskripsi</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Visual</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Dibuat</th>
                            <th class="text-center py-4 px-4 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($services as $service)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center">
                                        @if($service->icon)
                                            <i class="{{ $service->icon }} text-kai-blue text-xl"></i>
                                        @else
                                            <i class="fas fa-cogs text-kai-blue text-xl"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $service->nama_layanan }}</h4>
                                        <p class="text-sm text-gray-600">Penawaran Layanan</p>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <p class="text-sm text-gray-600">{{ Str::limit($service->deskripsi, 100) }}</p>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    @if($service->gambar)
                                        <img src="{{ asset('storage/' . $service->gambar) }}" 
                                             alt="Gambar Layanan" 
                                             class="w-12 h-12 object-cover rounded-lg shadow-md group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded-lg flex items-center justify-center">
                                            <i class="fas fa-image text-gray-400"></i>
                                        </div>
                                    @endif
                                    @if($service->icon)
                                        <div class="w-8 h-8 bg-kai-orange/10 rounded-full flex items-center justify-center">
                                            <i class="{{ $service->icon }} text-kai-orange text-sm"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-900">{{ $service->created_at->format('M d, Y') }}</div>
                                    <div class="text-gray-500">{{ $service->created_at->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.services.show', $service->id) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                       title="Lihat Layanan">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" 
                                       class="p-2 text-kai-blue hover:bg-kai-blue/10 rounded-lg transition-colors duration-200"
                                       title="Edit Layanan">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                            title="Delete Service"
                                            onclick="confirmDelete('{{ route('admin.services.destroy', $service->id) }}', 'Delete this service?')">
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
                @foreach($services as $service)
                <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all duration-300">
                    <div class="flex items-start space-x-4">
                        <div class="w-16 h-16 bg-kai-blue/10 rounded-full flex items-center justify-center flex-shrink-0">
                            @if($service->icon)
                                <i class="{{ $service->icon }} text-kai-blue text-2xl"></i>
                            @else
                                <i class="fas fa-cogs text-kai-blue text-2xl"></i>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 mb-1">{{ $service->nama_layanan }}</h4>
                            <p class="text-sm text-gray-600 mb-3">{{ Str::limit($service->deskripsi, 80) }}</p>
                            
                            @if($service->gambar)
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $service->gambar) }}" 
                                         alt="Service Image" 
                                         class="w-full h-32 object-cover rounded-lg">
                                </div>
                            @endif
                            
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500">
                                    <span>{{ $service->created_at->format('M d, Y') }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.services.show', $service->id) }}" 
                                       class="p-1 text-blue-600">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.services.edit', $service->id) }}" 
                                       class="p-1 text-kai-blue">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-1 text-red-600"
                                            onclick="confirmDelete('{{ route('admin.services.destroy', $service->id) }}', 'Delete this service?')">
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
                {{ $services->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-cogs text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Layanan Ditemukan</h3>
                <p class="text-gray-600 mb-8">Mulai dengan membuat layanan pertama untuk menampilkan penawaran Anda.</p>
                <a href="{{ route('admin.services.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Layanan Pertama
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
