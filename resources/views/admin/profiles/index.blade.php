@extends('admin.layouts.app')

@section('title', 'Manajemen Profil Perusahaan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-users mr-3 text-kai-orange"></i>
            Manajemen Profil Perusahaan
        </h1>
        <p class="text-gray-600">Kelola profil perusahaan dan informasi korporat</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.profiles.create') }}" 
           class="flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            Tambah Profil Perusahaan
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Profil</p>
                <p class="text-2xl font-bold text-kai-blue">{{ $profiles->count() }}</p>
            </div>
            <div class="bg-kai-blue/10 p-3 rounded-full">
                <i class="fas fa-users text-kai-blue text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Dengan Email</p>
                <p class="text-2xl font-bold text-green-500">{{ $profiles->whereNotNull('email')->count() }}</p>
            </div>
            <div class="bg-green-500/10 p-3 rounded-full">
                <i class="fas fa-envelope text-green-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-orange">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Dengan Telepon</p>
                <p class="text-2xl font-bold text-kai-orange">{{ $profiles->whereNotNull('telepon')->count() }}</p>
            </div>
            <div class="bg-kai-orange/10 p-3 rounded-full">
                <i class="fas fa-phone text-kai-orange text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Entri Minggu Ini</p>
                <p class="text-2xl font-bold text-purple-500">{{ $profiles->where('created_at', '>=', now()->subWeek())->count() }}</p>
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
            <h3 class="text-lg font-semibold">Semua Profil Perusahaan</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari profil perusahaan..." 
                           class="bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
                           id="searchInput">
                    <i class="fas fa-search absolute right-3 top-3 text-white/70"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        @if($profiles->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Nama Perusahaan</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Slogan</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Email</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Telepon</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Dibuat</th>
                            <th class="text-center py-4 px-4 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($profiles as $profile)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="py-4 px-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">{{ $profile->nama_perusahaan }}</h4>
                                    <p class="text-xs text-gray-500">ID: {{ $profile->id }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-kai-blue/10 text-kai-blue">
                                    <i class="fas fa-quote-left mr-1"></i>
                                    {{ Str::limit($profile->slogan, 30) }}
                                </span>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <i class="fas fa-envelope text-gray-400 mr-2"></i>
                                    <span class="text-sm text-gray-600">{{ $profile->email }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-gray-400 mr-2"></i>
                                    <span class="text-sm text-gray-600">{{ $profile->telepon }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-900">{{ $profile->created_at->format('M d, Y') }}</div>
                                    <div class="text-gray-500">{{ $profile->created_at->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.profiles.show', $profile->id) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                       title="Lihat Profil">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.profiles.edit', $profile->id) }}" 
                                       class="p-2 text-kai-blue hover:bg-kai-blue/10 rounded-lg transition-colors duration-200"
                                       title="Edit Profil">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                            title="Hapus Profil"
                                            onclick="confirmDelete('{{ route('admin.profiles.destroy', $profile->id) }}', 'Delete this profile?')">
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
                @foreach($profiles as $profile)
                <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all duration-300">
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 bg-gradient-to-br from-kai-blue to-kai-blue-light rounded-full flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-building text-white text-lg"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h4 class="font-semibold text-gray-900 mb-1">{{ $profile->nama_perusahaan }}</h4>
                                <p class="text-sm text-kai-blue">{{ $profile->slogan }}</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2 text-xs text-gray-600">
                            <div class="flex items-center">
                                <i class="fas fa-envelope mr-1"></i>
                                <span>{{ Str::limit($profile->email, 20) }}</span>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-phone mr-1"></i>
                                <span>{{ $profile->telepon }}</span>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="text-xs text-gray-500">
                                <span>{{ $profile->created_at->format('M d, Y') }}</span>
                            </div>
                            <div class="flex space-x-2">
                                <a href="{{ route('admin.profiles.show', $profile->id) }}" 
                                   class="p-1 text-blue-600">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.profiles.edit', $profile->id) }}" 
                                   class="p-1 text-kai-blue">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" 
                                        class="p-1 text-red-600"
                                        onclick="confirmDelete('{{ route('admin.profiles.destroy', $profile->id) }}', 'Delete this profile?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                {{ $profiles->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-users text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Profil Ditemukan</h3>
                <p class="text-gray-600 mb-8">Mulai dengan membuat profil tim pertama untuk menampilkan kepemimpinan Anda.</p>
                <a href="{{ route('admin.profiles.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Buat Profil Pertama
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
