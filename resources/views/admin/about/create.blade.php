@extends('admin.layouts.app')

@section('title', 'Buat Entri Tentang')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-plus mr-3 text-kai-orange"></i>
            Buat Entri Tentang
        </h1>
        <p class="text-gray-600">Tambah informasi perusahaan dan konten tentang baru</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.about.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Kembali ke Daftar
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Form -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-edit mr-3"></i>
                    Detail Entri Tentang
                </h3>
            </div>
            <div class="p-6">
                <form action="{{ route('admin.about.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Title Field -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul') }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('judul') border-red-500 @enderror"
                               placeholder="Masukkan judul untuk bagian tentang ini"
                               required>
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Content Field -->
                    <div>
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">
                            Konten <span class="text-red-500">*</span>
                        </label>
                        <textarea id="isi" 
                                  name="isi" 
                                  rows="12"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('isi') border-red-500 @enderror"
                                  placeholder="Masukkan konten detail untuk bagian tentang ini..."
                                  required>{{ old('isi') }}</textarea>
                        @error('isi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-1"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <p class="mt-2 text-sm text-gray-500">
                            <i class="fas fa-info-circle mr-1"></i>
                            Tulislah informasi detail tentang perusahaan, misi, visi, atau konten relevan lainnya.
                        </p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4 pt-6 border-t border-gray-200">
                        <button type="submit" 
                                class="flex items-center justify-center px-6 py-3 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                            <i class="fas fa-save mr-2"></i>
                            Buat Entri Tentang
                        </button>
                        <a href="{{ route('admin.about.index') }}" 
                           class="flex items-center justify-center px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-300">
                            <i class="fas fa-times mr-2"></i>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Guidelines -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-lightbulb mr-3"></i>
                    Panduan Penulisan
                </h3>
            </div>
            <div class="p-6">
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span>Gunakan judul yang jelas dan menarik yang menggambarkan konten</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span>Tulis dengan nada profesional namun mudah didekati</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span>Sertakan informasi perusahaan dan nilai-nilai yang relevan</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span>Jaga konten tetap informatif dan terkini</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-check-circle text-green-500 mr-2 mt-0.5 flex-shrink-0"></i>
                        <span>Periksa kembali sebelum menerbitkan</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Content Tips -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Tips Konten
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4 text-sm">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <h4 class="font-semibold text-blue-800 mb-2">Tentang Perusahaan</h4>
                        <p class="text-blue-700">Sertakan sejarah perusahaan, misi, visi, dan nilai-nilai inti.</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                        <h4 class="font-semibold text-green-800 mb-2">Ringkasan Layanan</h4>
                        <p class="text-green-700">Soroti layanan utama dan apa yang membuatnya unik.</p>
                    </div>
                    <div class="bg-purple-50 border border-purple-200 rounded-lg p-4">
                        <h4 class="font-semibold text-purple-800 mb-2">Tim & Budaya</h4>
                        <p class="text-purple-700">Tampilkan keahlian tim dan budaya perusahaan.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-gray-600 to-gray-700 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-eye mr-3"></i>
                    Pratinjau Langsung
                </h3>
            </div>
            <div class="p-6">
                <div id="preview-content" class="text-sm text-gray-600">
                    <p class="italic">Mulai mengetik untuk melihat pratinjau konten Anda...</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Live preview functionality
    document.getElementById('judul').addEventListener('input', updatePreview);
    document.getElementById('isi').addEventListener('input', updatePreview);

    function updatePreview() {
        const title = document.getElementById('judul').value;
        const content = document.getElementById('isi').value;
        const preview = document.getElementById('preview-content');
        
        if (title || content) {
            preview.innerHTML = `
                ${title ? `<h3 class="font-bold text-gray-900 mb-3">${title}</h3>` : ''}
                ${content ? `<div class="text-gray-700 leading-relaxed">${content.substring(0, 200)}${content.length > 200 ? '...' : ''}</div>` : ''}
            `;
        } else {
            preview.innerHTML = '<p class="italic text-gray-500">Start typing to see a preview dari your content...</p>';
        }
    }

    // Character counter
    document.getElementById('isi').addEventListener('input', function() {
        const maxLength = 5000;
        const currentLength = this.value.length;
        
        let counter = document.getElementById('char-counter');
        if (!counter) {
            counter = document.createElement('div');
            counter.id = 'char-counter';
            counter.className = 'text-sm text-gray-500 mt-2';
            this.parentNode.appendChild(counter);
        }
        
        counter.textContent = `${currentLength} characters`;
        counter.className = currentLength > maxLength * 0.9 ? 'text-sm text-orange-500 mt-2' : 'text-sm text-gray-500 mt-2';
    });

    // Auto-resize textarea
    document.getElementById('isi').addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });
</script>
@endpush
