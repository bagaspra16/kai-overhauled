@extends('admin.layouts.app')

@section('title', 'Lihat Artikel Berita')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-eye mr-3 text-kai-orange"></i>
            Lihat Artikel Berita
        </h1>
        <p class="text-gray-600">Article details and content</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.news.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.news.edit', $news->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-edit mr-2"></i>
            Edit Article
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-3">
        <!-- Article Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-8 py-6">
                <h1 class="text-2xl font-bold mb-4">{{ $news->judul }}</h1>
                <div class="flex flex-wrap items-center gap-6 text-white/90">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-user text-sm"></i>
                        </div>
                        <span>{{ $news->penulis }}</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-calendar text-sm"></i>
                        </div>
                        <span>{{ $news->tanggal->format('F d, Y') }}</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-sm"></i>
                        </div>
                        <span>{{ $news->created_at->diffForHumans() }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unggulan Image -->
        @if($news->gambar)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-image mr-3 text-kai-orange"></i>
                    Unggulan Image
                </h3>
                <div class="relative group">
                    <img src="{{ asset('storage/' . $news->gambar) }}" 
                         alt="{{ $news->judul }}" 
                         class="w-full h-auto rounded-lg shadow-md group-hover:shadow-xl transition-shadow duration-300 cursor-pointer"
                         onclick="openImageModal('{{ asset('storage/' . $news->gambar) }}', '{{ $news->judul }}')">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-lg flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Konten Artikel -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-newspaper mr-3"></i>
                    Konten Artikel
                </h3>
            </div>
            <div class="p-8">
                <div class="prose max-w-none">
                    {!! nl2br(e($news->isi)) !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Article Info -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Article Info
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Status</span>
                    @if($news->tanggal->isFuture())
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
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Created</span>
                    <span class="font-medium">{{ $news->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Updated</span>
                    <span class="font-medium">{{ $news->updated_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Word Jumlah</span>
                    <span class="font-medium">{{ str_word_count(strip_tags($news->isi)) }} words</span>
                </div>
                
                @if($news->gambar)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Has Image</span>
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                        <i class="fas fa-image mr-1"></i>
                        Yes
                    </span>
                </div>
                @endif
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-bolt mr-3"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.news.edit', $news->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Article
                </a>
                
                <button onclick="shareArticle()" 
                        class="flex items-center w-full p-3 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                    <i class="fas fa-share-alt mr-3"></i>
                    Share Article
                </button>
                
                <button onclick="printArticle()" 
                        class="flex items-center w-full p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                    <i class="fas fa-print mr-3"></i>
                    Print Article
                </button>
                
                <button onclick="confirmDelete('{{ route('admin.news.destroy', $news->id) }}', 'Delete this news article?')" 
                        class="flex items-center w-full p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-trash mr-3"></i>
                    Delete Article
                </button>
            </div>
        </div>

        <!-- Terbaru Articles -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-newspaper mr-3"></i>
                    Terbaru Articles
                </h3>
            </div>
            <div class="p-6">
                <div class="text-center py-8 bg-gray-50 rounded-lg">
                    <i class="fas fa-newspaper text-4xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600">Other recent articles will appear here</p>
                    <a href="{{ route('admin.news.index') }}" 
                       class="inline-flex items-center mt-3 text-kai-blue hover:text-kai-blue-light transition-colors duration-300">
                        <i class="fas fa-arrow-right mr-2"></i>
                        View All Articles
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" 
                class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <i class="fas fa-times text-2xl"></i>
        </button>
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
        <div class="absolute bottom-4 left-4 right-4 bg-black bg-opacity-50 text-white p-4 rounded-lg">
            <h3 id="modalTitle" class="font-semibold"></h3>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Open image modal
    function openImageModal(imageSrc, title) {
        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('imageModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    // Tutup image modal
    function closeImageModal() {
        document.getElementById('imageModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    // Tutup modal on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeImageModal();
        }
    });

    // Share article
    function shareArticle() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $news->judul }}',
                text: '{{ Str::limit(strip_tags($news->isi), 100) }}',
                url: window.location.href
            });
        } else {
            // Fallback: copy to clipboard
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Article URL copied to clipboard!');
            });
        }
    }

    // Print article
    function printArticle() {
        window.print();
    }

    // Add print styles
    const printStyles = `
        @media print {
            .sidebar, .page-header, nav, .quick-actions { display: none !important; }
            .main-content { width: 100% !important; }
            .article-content { font-size: 12pt; line-height: 1.5; }
        }
    `;
    
    const styleSheet = document.createElement('style');
    styleSheet.textContent = printStyles;
    document.head.appendChild(styleSheet);
</script>
@endpush
