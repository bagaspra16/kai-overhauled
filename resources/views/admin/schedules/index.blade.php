@extends('admin.layouts.app')

@section('title', 'Manajemen Jadwal')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-calendar-alt mr-3 text-kai-orange"></i>
            Manajemen Jadwal
        </h1>
        <p class="text-gray-600">Kelola jadwal kereta api dan waktu keberangkatan</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.schedules.create') }}" 
           class="flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            Tambah Jadwal Baru
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Jadwal</p>
                <p class="text-2xl font-bold text-kai-blue">{{ $schedules->total() }}</p>
            </div>
            <div class="bg-kai-blue/10 p-3 rounded-full">
                <i class="fas fa-calendar-alt text-kai-blue text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Jadwal Aktif</p>
                <p class="text-2xl font-bold text-green-500">{{ $schedules->where('is_active', true)->count() }}</p>
            </div>
            <div class="bg-green-500/10 p-3 rounded-full">
                <i class="fas fa-check-circle text-green-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-orange">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Kursi</p>
                <p class="text-2xl font-bold text-kai-orange">{{ number_format($schedules->sum('total_seats')) }}</p>
            </div>
            <div class="bg-kai-orange/10 p-3 rounded-full">
                <i class="fas fa-chair text-kai-orange text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Kursi Tersedia</p>
                <p class="text-2xl font-bold text-purple-500">{{ number_format($schedules->sum('available_seats')) }}</p>
            </div>
            <div class="bg-purple-500/10 p-3 rounded-full">
                <i class="fas fa-couch text-purple-500 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">Semua Jadwal</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari jadwal..." 
                           class="bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
                           id="searchInput">
                    <i class="fas fa-search absolute right-3 top-3 text-white/70"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        @if($schedules->count() > 0)
            <!-- Tampilan Tabel Desktop -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Kereta</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Rute</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Jadwal</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Kursi</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-center py-4 px-4 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($schedules as $schedule)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="py-4 px-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-train text-kai-blue text-lg"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-semibold text-gray-900">{{ $schedule->train_name }}</h4>
                                        <p class="text-sm text-gray-600">{{ $schedule->train_number }}</p>
                                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-kai-orange/10 text-kai-orange">
                                            {{ $schedule->train_class }}
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="space-y-1">
                                    <div class="flex items-center space-x-2">
                                        <span class="font-semibold text-kai-blue">{{ $schedule->route->originStation->code }}</span>
                                        <i class="fas fa-arrow-right text-gray-400"></i>
                                        <span class="font-semibold text-kai-orange">{{ $schedule->route->destinationStation->code }}</span>
                                    </div>
                                    <div class="text-sm text-gray-600">
                                        {{ $schedule->route->originStation->name }} → {{ $schedule->route->destinationStation->name }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $schedule->route->distance_km }} km • {{ $schedule->route->formatted_duration }}
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="space-y-1">
                                    <div class="flex items-center">
                                        <i class="fas fa-clock text-green-600 mr-2"></i>
                                        <span class="font-medium text-green-600">{{ $schedule->formatted_departure_time ?? 'N/A' }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-flag-checkered text-red-600 mr-2"></i>
                                        <span class="font-medium text-red-600">{{ $schedule->formatted_arrival_time ?? 'N/A' }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        Durasi: {{ $schedule->formatted_duration }}
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="space-y-2">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Tersedia:</span>
                                        <span class="font-semibold text-green-600">{{ $schedule->available_seats }}</span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600">Total:</span>
                                        <span class="font-semibold text-gray-700">{{ $schedule->total_seats }}</span>
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light h-2 rounded-full" 
                                             style="width: {{ ($schedule->total_seats - $schedule->available_seats) / $schedule->total_seats * 100 }}%"></div>
                                    </div>
                                    <div class="text-xs text-gray-500 text-center">
                                        {{ number_format(($schedule->total_seats - $schedule->available_seats) / $schedule->total_seats * 100, 1) }}% terisi
                                    </div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
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
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.schedules.show', $schedule->id) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                       title="Lihat Jadwal">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.schedules.edit', $schedule->id) }}" 
                                       class="p-2 text-kai-blue hover:bg-kai-blue/10 rounded-lg transition-colors duration-200"
                                       title="Edit Jadwal">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                            title="Hapus Jadwal"
                                            onclick="confirmDelete('{{ route('admin.schedules.destroy', $schedule->id) }}', 'Hapus jadwal ini?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tampilan Kartu Mobile -->
            <div class="lg:hidden space-y-4">
                @foreach($schedules as $schedule)
                <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all duration-300">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-kai-blue/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-train text-kai-blue text-lg"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900">{{ $schedule->train_name }}</h4>
                                <p class="text-sm text-gray-600">{{ $schedule->train_number }} • {{ $schedule->train_class }}</p>
                            </div>
                        </div>
                        @if($schedule->is_active)
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <i class="fas fa-check mr-1"></i>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                <i class="fas fa-times mr-1"></i>
                                Tidak Aktif
                            </span>
                        @endif
                    </div>
                    
                    <div class="mb-3">
                        <div class="flex items-center justify-between mb-2">
                            <span class="font-semibold text-kai-blue">{{ $schedule->route->originStation->code }}</span>
                            <i class="fas fa-arrow-right text-gray-400"></i>
                            <span class="font-semibold text-kai-orange">{{ $schedule->route->destinationStation->code }}</span>
                        </div>
                        <div class="text-sm text-gray-600 text-center">
                            {{ $schedule->route->originStation->name }} → {{ $schedule->route->destinationStation->name }}
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4 mb-3">
                        <div class="text-sm">
                            <span class="text-gray-600">Berangkat:</span>
                            <span class="font-medium ml-1 text-green-600">{{ $schedule->formatted_departure_time ?? 'N/A' }}</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-600">Tiba:</span>
                            <span class="font-medium ml-1 text-red-600">{{ $schedule->formatted_arrival_time ?? 'N/A' }}</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-600">Tersedia:</span>
                            <span class="font-medium ml-1 text-green-600">{{ $schedule->available_seats }}</span>
                        </div>
                        <div class="text-sm">
                            <span class="text-gray-600">Total:</span>
                            <span class="font-medium ml-1">{{ $schedule->total_seats }}</span>
                        </div>
                    </div>
                    
                    <div class="flex justify-end space-x-2">
                        <a href="{{ route('admin.schedules.show', $schedule->id) }}" 
                           class="p-1 text-blue-600">
                            <i class="fas fa-eye"></i>
                        </a>
                        <a href="{{ route('admin.schedules.edit', $schedule->id) }}" 
                           class="p-1 text-kai-blue">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button type="button" 
                                class="p-1 text-red-600"
                                onclick="confirmDelete('{{ route('admin.schedules.destroy', $schedule->id) }}', 'Hapus jadwal ini?')">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $schedules->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-calendar-alt text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Jadwal Ditemukan</h3>
                <p class="text-gray-600 mb-8">Mulai dengan membuat jadwal pertama untuk mengelola waktu keberangkatan kereta.</p>
                <a href="{{ route('admin.schedules.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Jadwal Pertama
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
