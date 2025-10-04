@extends('admin.layouts.app')

@section('title', 'Create News Article')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-plus mr-3 text-kai-orange"></i>
            Create News Article
        </h1>
        <p class="text-gray-600">Add a new article to your news collection</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.news.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>
</div>

<form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Article Details Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-newspaper mr-3"></i>
                        Article Details
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
                               value="{{ old('judul') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('judul') border-red-500 @enderror"
                               placeholder="Masukkan judul artikel..."
                               required>
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Author & Date Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="penulis" class="block text-sm font-medium text-gray-700 mb-2">
                                Author <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="penulis" 
                                   name="penulis" 
                                   value="{{ old('penulis', 'Admin KAI') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('penulis') border-red-500 @enderror"
                                   placeholder="Masukkan nama penulis..."
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
                                   value="{{ old('tanggal', date('Y-m-d')) }}"
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

                    <!-- Content -->
                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            Konten Artikel <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" 
                                  name="isi" 
                                  rows="12"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('isi') border-red-500 @enderror"
                                  placeholder="Write your article content here..."
                                  required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="mt-2 flex items-center justify-between text-sm text-gray-500">
                            <span>Write engaging content for your readers</span>
                            <span id="contentJumlaher">0 characters</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Unggulan Image Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-image mr-3"></i>
                        Unggulan Image
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="mb-4">
                        <label for="gambar" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Image
                        </label>
                        <div class="relative">
                            <input type="file" 
                                   id="gambar" 
                                   name="gambar" 
                                   accept="image/*"
                                   class="hidden"
                                   onchange="previewImage(this)">
                            <label for="gambar" 
                                   class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-gray-100 transition-colors duration-300">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-4"></i>
                                    <p class="mb-2 text-sm text-gray-500">
                                        <span class="font-semibold">Click to upload</span> or drag and drop
                                    </p>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                                </div>
                                <img id="imagePreview" class="hidden w-full h-full object-cover rounded-lg">
                            </label>
                        </div>
                        @error('gambar')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <div class="text-sm text-gray-600">
                        <p class="mb-2"><strong>Tips:</strong></p>
                        <ul class="space-y-1 text-xs">
                            <li>• Use high-quality images (1200x630px recommended)</li>
                            <li>• Keep file size under 2MB</li>
                            <li>• JPG or PNG format preferred</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Publishing Options -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-cog mr-3"></i>
                        Publishing Options
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Status</h4>
                            <p class="text-sm text-gray-600">Ready to publish</p>
                        </div>
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Visibility</h4>
                            <p class="text-sm text-gray-600">Public</p>
                        </div>
                        <i class="fas fa-globe text-kai-blue"></i>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Publish Article
                    </button>
                    
                    <button type="button" 
                            onclick="saveDraft()"
                            class="w-full bg-gradient-to-r from-gray-500 to-gray-600 text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-file-alt mr-2"></i>
                        Save as Draft
                    </button>
                    
                    <button type="button" 
                            onclick="previewArticle()"
                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        Preview Article
                    </button>
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
    // Character counter
    const contentTextarea = document.getElementById('isi');
    const contentJumlaher = document.getElementById('contentJumlaher');
    
    contentTextarea.addEventListener('input', function() {
        const count = this.value.length;
        contentJumlaher.textContent = `${count} characters`;
        
        if (count > 1000) {
            contentJumlaher.classList.add('text-kai-orange');
        } else {
            contentJumlaher.classList.remove('text-kai-orange');
        }
    });

    // Image preview
    function previewImage(input) {
        const file = input.files[0];
        const preview = document.getElementById('imagePreview');
        const uploadArea = document.getElementById('uploadArea');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
                uploadArea.classList.add('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // Save as draft
    function saveDraft() {
        const form = document.querySelector('form');
        const draftInput = document.createElement('input');
        draftInput.type = 'hidden';
        draftInput.name = 'save_as_draft';
        draftInput.value = '1';
        form.appendChild(draftInput);
        form.submit();
    }

    // Preview article
    function previewArticle() {
        const title = document.getElementById('judul').value;
        const author = document.getElementById('penulis').value;
        const date = document.getElementById('tanggal').value;
        const content = document.getElementById('isi').value;
        const imagePreview = document.getElementById('imagePreview');
        
        let previewHTML = `
            <article class="prose max-w-none">
                <header class="mb-8">
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">${title || 'Judul Artikel'}</h1>
                    <div class="flex items-center text-gray-600 text-sm mb-4">
                        <span>By ${author || 'Author'}</span>
                        <span class="mx-2">•</span>
                        <span>${date || 'Date'}</span>
                    </div>
                </header>
        `;
        
        if (!imagePreview.classList.contains('hidden')) {
            previewHTML += `<img src="${imagePreview.src}" alt="Unggulan Image" class="w-full h-64 object-cover rounded-lg mb-6">`;
        }
        
        previewHTML += `
                <div class="prose max-w-none">
                    ${content.replace(/\n/g, '<br>') || 'Article content will appear here...'}
                </div>
            </article>
        `;
        
        document.getElementById('previewContent').innerHTML = previewHTML;
        document.getElementById('previewModal').classList.remove('hidden');
    }

    // Tutup preview
    function closePreview() {
        document.getElementById('previewModal').classList.add('hidden');
    }

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const title = document.getElementById('judul').value.trim();
        const content = document.getElementById('isi').value.trim();
        
        if (!title || !content) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Publishing...';
        submitBtn.disabled = true;
    });

    // Auto-save functionality (optional)
    let autoSaveTimer;
    function autoSave() {
        clearTimeout(autoSaveTimer);
        autoSaveTimer = setTimeout(() => {
            // Implement auto-save logic here
            console.log('Auto-saving...');
        }, 30000); // Auto-save every 30 detik
    }

    // Trigger auto-save on input
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('input', autoSave);
    });
</script>
@endpush
