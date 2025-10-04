@extends('admin.layouts.app')

@section('title', 'Edit Layanan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-edit mr-3 text-kai-orange"></i>
            Edit Layanan
        </h1>
        <p class="text-gray-600">Perbarui informasi dan detail layanan</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.services.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.services.show', $service->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-eye mr-2"></i>
            Lihat Layanan
        </a>
    </div>
</div>

<form action="{{ route('admin.services.update', $service->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Layanan Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-cogs mr-3"></i>
                        Informasi Layanan
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
                               value="{{ old('nama_layanan', $service->nama_layanan) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('nama_layanan') border-red-500 @enderror"
                               placeholder="Masukkan nama layanan..."
                               required>
                        @error('nama_layanan')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-sm text-gray-500">Service display name</span>
                            <span id="nameJumlah" class="text-sm text-gray-400">0/100</span>
                        </div>
                    </div>

                    <!-- Icon Selection -->
                    <div>
                        <label for="icon" class="block text-sm font-medium text-gray-700 mb-2">
                            Ikon Layanan
                        </label>
                        <div class="grid grid-cols-8 gap-3 p-4 border border-gray-300 rounded-lg">
                            @php
                            $icons = [
                                'fas fa-train', 'fas fa-ticket-alt', 'fas fa-map-marked-alt', 'fas fa-clock',
                                'fas fa-wifi', 'fas fa-utensils', 'fas fa-bed', 'fas fa-car',
                                'fas fa-phone', 'fas fa-info-circle', 'fas fa-shield-alt', 'fas fa-headset',
                                'fas fa-credit-card', 'fas fa-mobile-alt', 'fas fa-luggage-cart', 'fas fa-wheelchair'
                            ];
                            @endphp
                            
                            @foreach($icons as $iconClass)
                            <label class="flex flex-col items-center p-3 border-2 border-transparent rounded-lg cursor-pointer hover:border-kai-blue hover:bg-kai-blue/5 transition-all duration-300">
                                <input type="radio" 
                                       name="icon" 
                                       value="{{ $iconClass }}" 
                                       class="sr-only"
                                       {{ old('icon', $service->icon) == $iconClass ? 'checked' : '' }}>
                                <i class="{{ $iconClass }} text-2xl text-gray-600 mb-1"></i>
                                <span class="text-xs text-gray-500">{{ substr($iconClass, strrpos($iconClass, '-') + 1) }}</span>
                            </label>
                            @endforeach
                        </div>
                        @error('icon')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">Select an icon to represent this service</p>
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  rows="6"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('deskripsi') border-red-500 @enderror"
                                  placeholder="Describe the service..."
                                  required>{{ old('deskripsi', $service->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="mt-2 flex items-center justify-between">
                            <span class="text-sm text-gray-500">Service description and details</span>
                            <span id="descJumlah" class="text-sm text-gray-400">0 words</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Service Image Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-image mr-3"></i>
                        Service Image
                    </h3>
                </div>
                
                <div class="p-6">
                    <!-- Current Image Display -->
                    @if($service->gambar)
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $service->gambar) }}" 
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
                            {{ $service->gambar ? 'Replace Image' : 'Upload Image' }}
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
            <!-- Service Preview -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-eye mr-3"></i>
                        Service Preview
                    </h3>
                </div>
                
                <div class="p-6">
                    <div id="servicePreview" class="bg-gray-50 rounded-lg p-6 text-center">
                        <div class="w-16 h-16 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i id="previewIcon" class="{{ $service->icon ?: 'fas fa-cogs' }} text-kai-blue text-2xl"></i>
                        </div>
                        <h4 id="previewName" class="font-semibold text-gray-900 mb-2">{{ $service->nama_layanan }}</h4>
                        <p id="previewDesc" class="text-sm text-gray-600">{{ Str::limit($service->deskripsi, 100) }}</p>
                    </div>
                    <p class="text-xs text-gray-500 mt-3 text-center">Live preview dari service card</p>
                </div>
            </div>

            <!-- Detail Layanan -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Detail Layanan
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Service ID</span>
                        <span class="font-mono text-kai-blue">#{{ $service->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Created</span>
                        <span class="text-sm">{{ $service->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Terakhir Updated</span>
                        <span class="text-sm">{{ $service->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Service
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
    // Character counting
    document.getElementById('nama_layanan').addEventListener('input', function() {
        const count = this.value.length;
        document.getElementById('nameJumlah').textContent = count + '/100';
        document.getElementById('previewName').textContent = this.value || 'Nama Layanan';
    });

    // Word counting for description
    document.getElementById('deskripsi').addEventListener('input', function() {
        const words = this.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        document.getElementById('descJumlah').textContent = words + ' words';
        document.getElementById('previewDesc').textContent = this.value.substring(0, 100) + (this.value.length > 100 ? '...' : '') || 'Service description';
    });

    // Icon selection
    document.querySelectorAll('input[name="icon"]').forEach(radio => {
        radio.addEventListener('change', function() {
            // Update visual selection
            document.querySelectorAll('label').forEach(label => {
                label.classList.remove('border-kai-blue', 'bg-kai-blue/5');
            });
            this.parentElement.classList.add('border-kai-blue', 'bg-kai-blue/5');
            
            // Update preview
            document.getElementById('previewIcon').className = this.value + ' text-kai-blue text-2xl';
        });
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
            const form = document.querySelector('form');
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'remove_image';
            hiddenInput.value = '1';
            form.appendChild(hiddenInput);
            
            document.querySelector('.relative.group').style.display = 'none';
        }
    }

    // Preview service
    function previewService() {
        const name = document.getElementById('nama_layanan').value;
        const desc = document.getElementById('deskripsi').value;
        const selectedIcon = document.querySelector('input[name="icon"]:checked');
        const icon = selectedIcon ? selectedIcon.value : 'fas fa-cogs';
        
        let previewHTML = `
            <div class="text-center">
                <div class="w-24 h-24 bg-kai-blue/10 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="${icon} text-kai-blue text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-4">${name || 'Nama Layanan'}</h2>
                <p class="text-gray-700 leading-relaxed">${desc || 'Service description will appear here...'}</p>
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
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating Service...';
        submitBtn.disabled = true;
    });

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Set initial selected icon style
        const selectedIcon = document.querySelector('input[name="icon"]:checked');
        if (selectedIcon) {
            selectedIcon.parentElement.classList.add('border-kai-blue', 'bg-kai-blue/5');
        }
        
        // Initialize counts
        const nameInput = document.getElementById('nama_layanan');
        document.getElementById('nameJumlah').textContent = nameInput.value.length + '/100';
        
        const descInput = document.getElementById('deskripsi');
        const words = descInput.value.trim().split(/\s+/).filter(word => word.length > 0).length;
        document.getElementById('descJumlah').textContent = words + ' words';
    });
</script>
@endpush
