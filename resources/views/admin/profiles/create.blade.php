@extends('admin.layouts.app')

@section('title', 'Create Profil Perusahaan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-plus mr-3 text-kai-orange"></i>
            Create Profil
        </h1>
        <p class="text-gray-600">Tambah profil perusahaan baru</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.profiles.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
    </div>
</div>

<form action="{{ route('admin.profiles.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Company Profile Details Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-user mr-3"></i>
                        Informasi Perusahaan
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Company Name -->
                    <div>
                        <label for="nama_perusahaan" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="nama_perusahaan" 
                               name="nama_perusahaan" 
                               value="{{ old('nama_perusahaan') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('nama_perusahaan') border-red-500 @enderror"
                               placeholder="Masukkan nama perusahaan..."
                               required>
                        @error('nama_perusahaan')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Slogan -->
                    <div>
                        <label for="slogan" class="block text-sm font-medium text-gray-700 mb-2">
                            Slogan Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="slogan" 
                               name="slogan" 
                               value="{{ old('slogan') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('slogan') border-red-500 @enderror"
                               placeholder="e.g., Innovation for Better Future"
                               required>
                        @error('slogan')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Vision -->
                    <div>
                        <label for="visi" class="block text-sm font-medium text-gray-700 mb-2">
                            Visi Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="visi" 
                                  name="visi" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('visi') border-red-500 @enderror"
                                  placeholder="Tuliskan visi perusahaan..."
                                  required>{{ old('visi') }}</textarea>
                        @error('visi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Mission -->
                    <div>
                        <label for="misi" class="block text-sm font-medium text-gray-700 mb-2">
                            Misi Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="misi" 
                                  name="misi" 
                                  rows="4"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('misi') border-red-500 @enderror"
                                  placeholder="Tuliskan misi perusahaan..."
                                  required>{{ old('misi') }}</textarea>
                        @error('misi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                            Alamat Perusahaan <span class="text-red-500">*</span>
                        </label>
                        <textarea id="alamat" 
                                  name="alamat" 
                                  rows="3"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('alamat') border-red-500 @enderror"
                                  placeholder="Tuliskan alamat lengkap perusahaan..."
                                  required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Contact Information Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('email') border-red-500 @enderror"
                                   placeholder="info@perusahaan.com"
                                   required>
                            @error('email')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                Telepon Perusahaan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   id="telepon" 
                                   name="telepon" 
                                   value="{{ old('telepon') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('telepon') border-red-500 @enderror"
                                   placeholder="+62 21 1234567"
                                   required>
                            @error('telepon')
                                <p class="mt-2 text-sm text-red-600 flex items-center">
                                    <i class="fas fa-exclamation-circle mr-2"></i>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Company Info Preview -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-eye mr-3"></i>
                        Preview Perusahaan
                    </h3>
                </div>
                
                <div class="p-6">
                    <div id="companyPreview" class="bg-gray-50 rounded-lg p-6 text-center">
                        <div class="w-20 h-20 bg-gradient-to-br from-kai-blue to-kai-blue-light rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-building text-white text-2xl"></i>
                        </div>
                        <h4 id="livePreviewName" class="font-semibold text-gray-900 mb-1">Nama Perusahaan</h4>
                        <p id="livePreviewSlogan" class="text-sm text-kai-blue font-medium mb-2">Slogan Perusahaan</p>
                        <div class="text-xs text-gray-600 space-y-1">
                            <p id="livePreviewEmail">email@perusahaan.com</p>
                            <p id="livePreviewPhone">+62 21 1234567</p>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-3 text-center">Live preview company card</p>
                </div>
            </div>

            <!-- Company Status -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-cog mr-3"></i>
                        Profil Settings
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Status</h4>
                            <p class="text-sm text-gray-600">Profile will be active</p>
                        </div>
                        <div class="w-3 h-3 bg-green-500 rounded-full"></div>
                    </div>
                    
                    <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                        <div>
                            <h4 class="font-medium text-gray-900">Visibility</h4>
                            <p class="text-sm text-gray-600">Public profile</p>
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
                        Create Profil
                    </button>
                    
                    <button type="button" 
                            onclick="previewProfile()"
                            class="w-full bg-gradient-to-r from-kai-orange to-kai-orange-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-eye mr-2"></i>
                        Preview Profil
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
            <h3 class="text-xl font-semibold text-gray-900">Profil Preview</h3>
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
    // Live preview updates
    document.getElementById('nama_perusahaan').addEventListener('input', function() {
        document.getElementById('livePreviewName').textContent = this.value || 'Nama Perusahaan';
    });

    document.getElementById('slogan').addEventListener('input', function() {
        document.getElementById('livePreviewSlogan').textContent = this.value || 'Slogan Perusahaan';
    });

    document.getElementById('email').addEventListener('input', function() {
        document.getElementById('livePreviewEmail').textContent = this.value || 'email@perusahaan.com';
    });

    document.getElementById('telepon').addEventListener('input', function() {
        document.getElementById('livePreviewPhone').textContent = this.value || '+62 21 1234567';
    });

    // Preview profile
    function previewProfile() {
        const namaPerusahaan = document.getElementById('nama_perusahaan').value;
        const slogan = document.getElementById('slogan').value;
        const visi = document.getElementById('visi').value;
        const misi = document.getElementById('misi').value;
        const alamat = document.getElementById('alamat').value;
        const email = document.getElementById('email').value;
        const telepon = document.getElementById('telepon').value;
        
        let previewHTML = `
            <div class="text-center">
                <div class="w-32 h-32 bg-gradient-to-br from-kai-blue to-kai-blue-light rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-building text-white text-4xl"></i>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">${namaPerusahaan || 'Nama Perusahaan'}</h2>
                <p class="text-lg text-kai-blue font-medium mb-6">${slogan || 'Slogan Perusahaan'}</p>
                
                <div class="text-left space-y-4">
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Visi</h3>
                        <p class="text-gray-700">${visi || 'Visi perusahaan akan tampil di sini...'}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Misi</h3>
                        <p class="text-gray-700">${misi || 'Misi perusahaan akan tampil di sini...'}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="font-semibold text-gray-900 mb-2">Kontak</h3>
                        <div class="space-y-2 text-sm">
                            <p><i class="fas fa-map-marker-alt mr-2 text-kai-blue"></i>${alamat || 'Alamat perusahaan'}</p>
                            <p><i class="fas fa-envelope mr-2 text-kai-blue"></i>${email || 'email@perusahaan.com'}</p>
                            <p><i class="fas fa-phone mr-2 text-kai-blue"></i>${telepon || '+62 21 1234567'}</p>
                        </div>
                    </div>
                </div>
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
        const namaPerusahaan = document.getElementById('nama_perusahaan').value.trim();
        const slogan = document.getElementById('slogan').value.trim();
        const visi = document.getElementById('visi').value.trim();
        const misi = document.getElementById('misi').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const email = document.getElementById('email').value.trim();
        const telepon = document.getElementById('telepon').value.trim();
        
        if (!namaPerusahaan || !slogan || !visi || !misi || !alamat || !email || !telepon) {
            e.preventDefault();
            alert('Mohon lengkapi semua field yang diperlukan.');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Creating Company Profile...';
        submitBtn.disabled = true;
    });
</script>
@endpush
