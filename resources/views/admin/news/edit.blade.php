@extends('admin.layouts.app')

@section('title', 'Edit Artikel Berita')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-edit mr-3 text-kai-orange"></i>
            Edit Artikel Berita
        </h1>
        <p class="text-gray-600">Perbarui informasi dan konten artikel</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.news.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.news.show', $news->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-eye mr-2"></i>
            View Article
        </a>
    </div>
</div>

<form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Artikel Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-newspaper mr-3"></i>
                        Informasi Artikel
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Artikel <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul', $news->judul) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('judul') border-red-500 @enderror"
                               placeholder="Masukkan judul artikel..."
                               required>
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-sm text-gray-500">Article title for display</span>
                            <span id="titleJumlah" class="text-sm text-gray-400">0/100</span>
                        </div>
                    </div>

                    <!-- Author and Date Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">
                                Author <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="penulis" 
                                   name="penulis" 
                                   value="{{ old('penulis', $news->penulis) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('penulis') border-red-500 @enderror"
                                   placeholder="Author name..."
                                   required>
                            @error('penulis')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Publikasi <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   id="tanggal" 
                                   name="tanggal" 
                                   value="{{ old('tanggal', $news->tanggal->format('Y-m-d')) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('tanggal') border-red-500 @enderror"
                                   required>
                            @error('tanggal')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- Konten Artikel Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-file-alt mr-3"></i>
                        Konten Artikel
                    </h3>
                </div>
                
                <div class="p-6">
                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            Content <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" 
                                  name="isi" 
                                  rows="12"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('isi') border-red-500 @enderror"
                                  placeholder="Write your article content here..."
                                  required>{{ old('isi', $news->isi) }}</textarea>
                        @error('isi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-sm text-gray-500">Article main content</span>
                            <span id="contentJumlah" class="text-sm text-gray-400">0 words</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Image Upload Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-image mr-3"></i>
                        Unggulan Image
                    </h3>
                </div>
                
                <div class="p-6">
                    <!-- Current Image Display -->
                    @if($news->gambar)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $news->gambar) }}" 
                                 alt="Current image" 
                                 class="w-full h-48 object-cover rounded-lg shadow-md">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 rounded-lg flex items-center justify-center">
                                <button type="button" 
                                        onclick="removeCurrentImage()"
                                        class="opacity-0 group-hover:opacity-100 bg-red-500 text-white px-4 py-2 rounded-lg transition-opacity duration-300">
                                    <i class="fas fa-trash mr-2"></i>Remove
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Image Upload -->
                    <div>
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                            {{ $news->gambar ? 'Replace Image' : 'Upload Image' }}
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-kai-blue transition-colors duration-300"
                             ondrop="handleDrop(event)" 
                             ondragover="handleDragOver(event)" 
                             ondragleave="handleDragLeave(event)">
                            <div class="space-y-1 text-center">
                                <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                <div class="flex text-sm text-gray-600">
                                    <label for="gambar" class="relative cursor-pointer bg-white rounded-md font-medium text-kai-blue hover:text-kai-blue-light focus-within:outline-none focus-within:ring-2 focus-within:ring-darifset-2 focus-within:ring-kai-blue">
                                        <span>Upload a file</span>
                                        <input id="gambar" name="gambar" type="file" class="sr-only" accept="image/*" onchange="previewImage(this)">
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        @error('gambar')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div id="imagePreview" class="mt-4 hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">New Image Preview</label>
                        <img id="previewImg" src="" alt="Preview" class="w-full h-48 object-cover rounded-lg shadow-md">
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Article Status -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Article Status
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Status Saat Ini</span>
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
                        <span class="text-sm">{{ $news->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Terakhir Updated</span>
                        <span class="text-sm">{{ $news->updated_at->format('M d, Y') }}</span>
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
                    <button type="button" 
                            onclick="previewArticle()"
                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        Preview Changes
                    </button>
                    
                    <button type="button" 
                            onclick="saveDraft()"
                            class="w-full bg-gradient-to-r from-gray-500 to-gray-600 text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Save as Draft
                    </button>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Article
                    </button>
                    
                    <a href="{{ route('admin.news.show', $news->id) }}" 
                       class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        View Article
                    </a>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Article Preview</h3>
            <button type="button" onclick="closePreview()" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times text-xl"></i>
            </button>
        </div>
        <div class="p-6" id="previewContent">
            <!-- Preview content will be inserted here -->
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Character counting
    document.getElementById('judul').addEventListener('input', function() {
        const count = this.value.length;
        document.getElementById('titleJumlah').textContent = count + '/100';
        if (count > 100) {
            document.getElementById('titleJumlah').classList.add('text-red-500');
        } else {
            document.getElementById('titleJumlah').classList.remove('text-red-500');
        }
    });

    // Word counting for content
    document.getElementById('isi').addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        document.getElementById('contentJumlah').textContent = words + ' words';
    });

    // Image preview
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    // Drag and drop handlers
    function handleDragOver(e) {
        e.preventDefault();
        e.currentTarget.classList.add('border-kai-blue', 'bg-kai-blue/5');
    }

    function handleDragLeave(e) {
        e.preventDefault();
        e.currentTarget.classList.remove('border-kai-blue', 'bg-kai-blue/5');
    }

    function handleDrop(e) {
        e.preventDefault();
        e.currentTarget.classList.remove('border-kai-blue', 'bg-kai-blue/5');
        
        const files = e.dataTransfer.files;
        if (files.length > 0) {
            document.getElementById('gambar').files = files;
            previewImage(document.getElementById('gambar'));
        }
    }

    // Remove current image
    function removeCurrentImage() {
        if (confirm('Apakah Anda yakin you want to remove the current image?')) {
            // Add hidden input to mark image for removal
            const form = document.querySelector('form');
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'remove_image';
            hiddenInput.value = '1';
            form.appendChild(hiddenInput);
            
            // Hide current image display
            document.querySelector('.relative.group').style.display = 'none';
        }
    }

    // Preview article
    function previewArticle() {
        const title = document.getElementById('judul').value;
        const author = document.getElementById('penulis').value;
        const date = document.getElementById('tanggal').value;
        const content = document.getElementById('isi').value;
        
        let previewHTML = `
            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-4">${title || 'Judul Artikel'}</h1>
                <div class="flex items-center justify-center space-x-4 text-gray-600">
                    <span><i class="fas fa-user mr-1"></i>${author || 'Author'}</span>
                    <span><i class="fas fa-calendar mr-1"></i>${date || 'Date'}</span>
                </div>
            </div>
            <div class="prose max-w-none">
                <p class="text-gray-700 leading-relaxed">${content.replace(/\n/g, '<br>') || 'Article content will appear here...'}</p>
            </div>
        `;
        
        document.getElementById('previewContent').innerHTML = previewHTML;
        document.getElementById('previewModal').classList.remove('hidden');
    }

    // Tutup preview
    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    // Save draft
    function saveDraft() {
        alert('Draft saved! (This would save the current state without publishing)');
    }

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating Article...';
        submitBtn.disabled = true;
    });

    // Initialize counts on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize title count
        const titleInput = document.getElementById('judul');
        const titleJumlah = titleInput.value.length;
        document.getElementById('titleJumlah').textContent = titleJumlah + '/100';
        
        // Initialize content count
        const contentInput = document.getElementById('isi');
        const words = contentInput.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        document.getElementById('contentJumlah').textContent = words + ' words';
    });
</script>
@endpush
