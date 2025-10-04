@extends('admin.layouts.app')

@section('title', 'Lihat Layanan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-eye mr-3 text-kai-orange"></i>
            Lihat Layanan
        </h1>
        <p class="text-gray-600">Service details and information</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.services.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.services.edit', $service->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-edit mr-2"></i>
            Edit Layanan
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Service Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-8 py-8 text-center">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    @if($service->icon)
                        <i class="{{ $service->icon }} text-white text-4xl"></i>
                    @else
                        <i class="fas fa-cogs text-white text-4xl"></i>
                    @endif
                </div>
                <h1 class="text-3xl font-bold mb-2">{{ $service->nama_layanan }}</h1>
                <p class="text-white/90">KAI Service Offering</p>
            </div>
        </div>

        <!-- Service Image -->
        @if($service->gambar)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-image mr-3"></i>
                    Service Image
                </h3>
            </div>
            <div class="p-6">
                <div class="relative group">
                    <img src="{{ asset('storage/' . $service->gambar) }}" 
                         alt="{{ $service->nama_layanan }}" 
                         class="w-full h-auto rounded-lg shadow-md group-hover:shadow-xl transition-shadow duration-300 cursor-pointer"
                         onclick="openImageModal('{{ asset('storage/' . $service->gambar) }}', '{{ $service->nama_layanan }}')">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-lg flex items-center justify-center">
                        <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <!-- Deskripsi Layanan -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Deskripsi Layanan
                </h3>
            </div>
            <div class="p-8">
                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed text-lg">{{ $service->deskripsi }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Detail Layanan -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-cogs mr-3"></i>
                    Detail Layanan
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Nama Layanan</span>
                    <span class="font-medium text-right">{{ $service->nama_layanan }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Icon</span>
                    <div class="flex items-center">
                        @if($service->icon)
                            <i class="{{ $service->icon }} text-kai-blue text-xl mr-2"></i>
                            <span class="font-mono text-sm">{{ $service->icon }}</span>
                        @else
                            <span class="text-gray-400">No icon</span>
                        @endif
                    </div>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Has Image</span>
                    @if($service->gambar)
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                            <i class="fas fa-check mr-1"></i>
                            Yes
                        </span>
                    @else
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                            <i class="fas fa-times mr-1"></i>
                            No
                        </span>
                    @endif
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Created</span>
                    <span class="font-medium">{{ $service->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Updated</span>
                    <span class="font-medium">{{ $service->updated_at->format('M d, Y') }}</span>
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
                <a href="{{ route('admin.services.edit', $service->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Layanan
                </a>
                
                <button onclick="shareService()" 
                        class="flex items-center w-full p-3 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                    <i class="fas fa-share-alt mr-3"></i>
                    Share Service
                </button>
                
                <button onclick="printService()" 
                        class="flex items-center w-full p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                    <i class="fas fa-print mr-3"></i>
                    Print Details
                </button>
                
                <button onclick="confirmDelete('{{ route('admin.services.destroy', $service->id) }}', 'Delete this service?')" 
                        class="flex items-center w-full p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-trash mr-3"></i>
                    Delete Service
                </button>
            </div>
        </div>

        <!-- Service Preview -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-eye mr-3"></i>
                    Public Preview
                </h3>
            </div>
            <div class="p-6">
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <div class="w-16 h-16 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                        @if($service->icon)
                            <i class="{{ $service->icon }} text-kai-blue text-2xl"></i>
                        @else
                            <i class="fas fa-cogs text-kai-blue text-2xl"></i>
                        @endif
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-2">{{ $service->nama_layanan }}</h4>
                    <p class="text-sm text-gray-600">{{ Str::limit($service->deskripsi, 100) }}</p>
                </div>
                <p class="text-xs text-gray-500 mt-3 text-center">This is how the service appears to users</p>
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

    // Share service
    function shareService() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $service->nama_layanan }}',
                text: '{{ Str::limit($service->deskripsi, 100) }}',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Service URL copied to clipboard!');
            });
        }
    }

    // Print service
    function printService() {
        window.print();
    }
</script>
@endpush
