@extends('admin.layouts.app')

@section('title', 'Create Service')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-plus mr-3 text-kai-orange"></i>
            Create Service
        </h1>
        <p class="text-gray-600">Add a new service to your dariferings</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.services.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>
</div>

<form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Detail Layanan Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-cogs mr-3"></i>
                        Detail Layanan
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Nama Layanan -->
                    <div>
                        <label for="nama_layanan" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Layanan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama_layanan" 
                               name="nama_layanan" 
                               value="{{ old('nama_layanan') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('nama_layanan') border-red-500 @enderror"
                               placeholder="Masukkan nama layanan..."
                               required>
                        @error('nama_layanan')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Layanan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  rows="8"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('deskripsi') border-red-500 @enderror"
                                  placeholder="Describe your service in detail..."
                                  required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="mt-2 flex items-center justify-between text-sm text-gray-500">
                            <span>Provide detailed information about this service</span>
                            <span id="descJumlaher">0 characters</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Icon Selection Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-icons mr-3"></i>
                        Ikon Layanan
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="mb-4">
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                            Select Icon
                        </label>
                        <select id="icon" 
                                name="icon" 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('icon') border-red-500 @enderror"
                                onchange="updateIconPreview()">
                            <option value="">Choose an icon...</option>
                            <option value="fas fa-train" {{ old('icon') == 'fas fa-train' ? 'selected' : '' }}>Train</option>
                            <option value="fas fa-ticket-alt" {{ old('icon') == 'fas fa-ticket-alt' ? 'selected' : '' }}>Ticket</option>
                            <option value="fas fa-map-marker-alt" {{ old('icon') == 'fas fa-map-marker-alt' ? 'selected' : '' }}>Location</option>
                            <option value="fas fa-clock" {{ old('icon') == 'fas fa-clock' ? 'selected' : '' }}>Schedule</option>
                            <option value="fas fa-wifi" {{ old('icon') == 'fas fa-wifi' ? 'selected' : '' }}>WiFi</option>
                            <option value="fas fa-cdarifee" {{ old('icon') == 'fas fa-cdarifee' ? 'selected' : '' }}>Food & Beverage</option>
                            <option value="fas fa-shield-alt" {{ old('icon') == 'fas fa-shield-alt' ? 'selected' : '' }}>Security</option>
                            <option value="fas fa-headphones" {{ old('icon') == 'fas fa-headphones' ? 'selected' : '' }}>Customer Service</option>
                            <option value="fas fa-luggage-cart" {{ old('icon') == 'fas fa-luggage-cart' ? 'selected' : '' }}>Baggage</option>
                            <option value="fas fa-wheelchair" {{ old('icon') == 'fas fa-wheelchair' ? 'selected' : '' }}>Accessibility</option>
                            <option value="fas fa-parking" {{ old('icon') == 'fas fa-parking' ? 'selected' : '' }}>Parking</option>
                            <option value="fas fa-credit-card" {{ old('icon') == 'fas fa-credit-card' ? 'selected' : '' }}>Payment</option>
                        </select>
                        @error('icon')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                    
                    <!-- Icon Preview -->
                    <div class="flex items-center justify-center p-8 bg-gray-50 rounded-lg">
                        <div id="iconPreview" class="w-16 h-16 bg-kai-blue/10 rounded-full flex items-center justify-center">
                            <i id="previewIcon" class="fas fa-cogs text-kai-blue text-2xl"></i>
                        </div>
                    </div>
                    
                    <div class="mt-4 text-sm text-gray-600">
                        <p><strong>Icon Preview:</strong></p>
                        <p class="text-xs mt-1">Select an icon to see how it will appear</p>
                    </div>
                </div>
            </div>

            <!-- Service Image Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-image mr-3"></i>
                        Service Image
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
                            <li>• Use high-quality images (800x600px recommended)</li>
                            <li>• Keep file size under 2MB</li>
                            <li>• JPG or PNG format preferred</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Create Service
                    </button>
                    
                    <button type="button" 
                            onclick="previewService()"
                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        Preview Service
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Preview Modal -->
<div id="previewModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
        <div class="flex items-center justify-between p-6 border-b">
            <h3 class="text-xl font-semibold text-gray-900">Service Preview</h3>
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
    const descTextarea = document.getElementById('deskripsi');
    const descJumlaher = document.getElementById('descJumlaher');
    
    descTextarea.addEventListener('input', function() {
        const count = this.value.length;
        descJumlaher.textContent = `${count} characters`;
        
        if (count > 500) {
            descJumlaher.classList.add('text-kai-orange');
        } else {
            descJumlaher.classList.remove('text-kai-orange');
        }
    });

    // Icon preview update
    function updateIconPreview() {
        const iconSelect = document.getElementById('icon');
        const previewIcon = document.getElementById('previewIcon');
        
        if (iconSelect.value) {
            previewIcon.className = iconSelect.value + ' text-kai-blue text-2xl';
        } else {
            previewIcon.className = 'fas fa-cogs text-kai-blue text-2xl';
        }
    }

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

    // Preview service
    function previewService() {
        const name = document.getElementById('nama_layanan').value;
        const description = document.getElementById('deskripsi').value;
        const icon = document.getElementById('icon').value;
        const imagePreview = document.getElementById('imagePreview');
        
        let previewHTML = `
            <div class="text-center">
                <div class="w-20 h-20 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="${icon || 'fas fa-cogs'} text-kai-blue text-3xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">${name || 'Nama Layanan'}</h2>
        `;
        
        if (!imagePreview.classList.contains('hidden')) {
            previewHTML += `<img src="${imagePreview.src}" alt="Service Image" class="w-full h-48 object-cover rounded-lg mb-4">`;
        }
        
        previewHTML += `
                <p class="text-gray-600 leading-relaxed">${description || 'Service description will appear here...'}</p>
            </div>
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
        const name = document.getElementById('nama_layanan').value.trim();
        const description = document.getElementById('deskripsi').value.trim();
        
        if (!name || !description) {
            e.preventDefault();
            alert('Please fill in all required fields.');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Service...';
        submitBtn.disabled = true;
    });

    // Initialize icon preview on page load
    document.addEventListener('DOMContentLoaded', function() {
        updateIconPreview();
    });
</script>
@endpush
