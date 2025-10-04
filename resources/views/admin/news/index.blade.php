@extends('admin.layouts.app')

@section('title', 'Manajemen Berita')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-newspaper mr-3 text-kai-orange"></i>
            Manajemen Berita
        </h1>
        <p class="text-gray-600">Kelola artikel berita dan publikasi</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.news.create') }}" 
           class="flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-plus mr-2"></i>
            Tambah Artikel Baru
        </a>
    </div>
</div>

<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-blue">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Artikel</p>
                <p class="text-2xl font-bold text-kai-blue">{{ $news->total() }}</p>
            </div>
            <div class="bg-kai-blue/10 p-3 rounded-full">
                <i class="fas fa-newspaper text-kai-blue text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Diterbitkan Hari Ini</p>
                <p class="text-2xl font-bold text-green-500">{{ $news->where('tanggal', today())->count() }}</p>
            </div>
            <div class="bg-green-500/10 p-3 rounded-full">
                <i class="fas fa-calendar-check text-green-500 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-kai-orange">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">This Month</p>
                <p class="text-2xl font-bold text-kai-orange">{{ $news->where('tanggal', '>=', now()->startOfMonth())->count() }}</p>
            </div>
            <div class="bg-kai-orange/10 p-3 rounded-full">
                <i class="fas fa-chart-line text-kai-orange text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">With Images</p>
                <p class="text-2xl font-bold text-purple-500">{{ $news->whereNotNull('gambar')->count() }}</p>
            </div>
            <div class="bg-purple-500/10 p-3 rounded-full">
                <i class="fas fa-image text-purple-500 text-xl"></i>
            </div>
        </div>
    </div>
</div>

<!-- Main Content -->
<div class="bg-white rounded-xl shadow-lg overflow-hidden">
    <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-semibold">All Artikel Berita</h3>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" 
                           placeholder="Cari articles..." 
                           class="bg-white/20 text-white placeholder-white/70 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/50 transition-all duration-300"
                           id="searchInput">
                    <i class="fas fa-search absolute right-3 top-3 text-white/70"></i>
                </div>
            </div>
        </div>
    </div>
    
    <div class="p-6">
        @if($news->count() > 0)
            <!-- Desktop Table View -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200">
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Gambar</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Article</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Penulis</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Tanggal</th>
                            <th class="text-left py-4 px-4 font-semibold text-gray-700">Status</th>
                            <th class="text-center py-4 px-4 font-semibold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($news as $article)
                        <tr class="hover:bg-gray-50 transition-colors duration-200 group">
                            <td class="py-4 px-4">
                                @if($article->gambar)
                                    <img src="{{ asset('storage/' . $article->gambar) }}" 
                                         alt="News Image" 
                                         class="w-16 h-16 object-cover rounded-lg shadow-md group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div class="w-16 h-16 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-image text-gray-400 text-xl"></i>
                                    </div>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div>
                                    <h4 class="font-semibold text-gray-900 mb-1">{{ Str::limit($article->judul, 50) }}</h4>
                                    <p class="text-sm text-gray-600">{{ Str::limit(strip_tags($article->isi), 80) }}</p>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-kai-blue rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-user text-white text-sm"></i>
                                    </div>
                                    <span class="font-medium text-gray-700">{{ $article->penulis }}</span>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                <div class="text-sm">
                                    <div class="font-medium text-gray-900">{{ $article->tanggal->format('M d, Y') }}</div>
                                    <div class="text-gray-500">{{ $article->tanggal->diffForHumans() }}</div>
                                </div>
                            </td>
                            <td class="py-4 px-4">
                                @if($article->tanggal->isFuture())
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i>
                                        Scheduled
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check mr-1"></i>
                                        Published
                                    </span>
                                @endif
                            </td>
                            <td class="py-4 px-4">
                                <div class="flex items-center justify-center space-x-2">
                                    <a href="{{ route('admin.news.show', $article->id) }}" 
                                       class="p-2 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors duration-200"
                                       title="View Article">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.news.edit', $article->id) }}" 
                                       class="p-2 text-kai-blue hover:bg-kai-blue/10 rounded-lg transition-colors duration-200"
                                       title="Edit Article">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-2 text-red-600 hover:bg-red-100 rounded-lg transition-colors duration-200"
                                            title="Delete Article"
                                            onclick="confirmDelete('{{ route('admin.news.destroy', $article->id) }}', 'Delete this news article?')">
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
                @foreach($news as $article)
                <div class="bg-gray-50 rounded-lg p-4 hover:shadow-md transition-all duration-300">
                    <div class="flex space-x-4">
                        @if($article->gambar)
                            <img src="{{ asset('storage/' . $article->gambar) }}" 
                                 alt="News Image" 
                                 class="w-20 h-20 object-cover rounded-lg flex-shrink-0">
                        @else
                            <div class="w-20 h-20 bg-gray-200 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-image text-gray-400 text-xl"></i>
                            </div>
                        @endif
                        <div class="flex-1 min-w-0">
                            <h4 class="font-semibold text-gray-900 mb-1">{{ Str::limit($article->judul, 40) }}</h4>
                            <p class="text-sm text-gray-600 mb-2">{{ Str::limit(strip_tags($article->isi), 60) }}</p>
                            <div class="flex items-center justify-between">
                                <div class="text-xs text-gray-500">
                                    <span>{{ $article->penulis }}</span> • 
                                    <span>{{ $article->tanggal->format('M d, Y') }}</span>
                                </div>
                                <div class="flex space-x-2">
                                    <a href="{{ route('admin.news.show', $article->id) }}" 
                                       class="p-1 text-blue-600">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.news.edit', $article->id) }}" 
                                       class="p-1 text-kai-blue">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="p-1 text-red-600"
                                            onclick="confirmDelete('{{ route('admin.news.destroy', $article->id) }}', 'Delete this news article?')">
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
                {{ $news->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Artikel Berita Found</h3>
                <p class="text-gray-600 mb-8">Start by creating your first news article to engage your audience.</p>
                <a href="{{ route('admin.news.create') }}" 
                   class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-plus mr-2"></i>
                    Create Pertama Article
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
