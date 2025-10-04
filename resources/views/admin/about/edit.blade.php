@extends('admin.layouts.app')

@section('title', 'Edit Entri Tentang')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-edit mr-3 text-kai-orange"></i>
            Edit Entri Tentang
        </h1>
        <p class="text-gray-600">Perbarui informasi dan sejarah perusahaan</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.about.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.about.show', $about->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-eye mr-2"></i>
            View Entry
        </a>
    </div>
</div>

<form action="{{ route('admin.about.update', $about->id) }}" method="POST" class="space-y-8">
    @csrf
    @method('PUT')
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Informasi Entri Card -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Informasi Entri
                    </h3>
                </div>
                
                <div class="p-6 space-y-6">
                    <!-- Title -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                            Judul Entri <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               id="judul" 
                               name="judul" 
                               value="{{ old('judul', $about->judul) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('judul') border-red-500 @enderror"
                               placeholder="e.g., Company Foundation"
                               required>
                        @error('judul')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Tahun -->
                    <div>
                        <label for="tahun" class="block text-sm font-medium text-gray-700 mb-2">
                            Tahun <span class="text-red-500">*</span>
                        </label>
                        <input type="number" 
                               id="tahun" 
                               name="tahun" 
                               value="{{ old('tahun', $about->tahun) }}"
                               min="1800"
                               max="{{ date('Y') + 10 }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('tahun') border-red-500 @enderror"
                               placeholder="e.g., {{ date('Y') }}"
                               required>
                        @error('tahun')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Description <span class="text-red-500">*</span>
                        </label>
                        <textarea id="deskripsi" 
                                  name="deskripsi" 
                                  rows="8"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('deskripsi') border-red-500 @enderror"
                                  placeholder="Enter detailed description about this entry..."
                                  required>{{ old('deskripsi', $about->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <i class="fas fa-exclamation-circle mr-2"></i>
                                {{ $message }}
                            </p>
                        @enderror
                        <div class="flex items-center justify-between mt-2">
                            <p class="text-sm text-gray-500">Provide comprehensive information about this historical entry</p>
                            <span id="charJumlah" class="text-sm text-gray-400">0 characters</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Current Entry Info -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-info-circle mr-3"></i>
                        Info Saat Ini
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Entry ID</span>
                        <span class="font-mono text-kai-blue">#{{ $about->id }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Current Title</span>
                        <span class="font-medium text-right">{{ Str::limit($about->judul, 20) }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Current Tahun</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-kai-blue text-white">
                            {{ $about->tahun }}
                        </span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Created</span>
                        <span class="font-medium">{{ $about->created_at->format('M d, Y') }}</span>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <span class="text-gray-600">Updated</span>
                        <span class="font-medium">{{ $about->updated_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </div>

            <!-- Content Statistik -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-chart-bar mr-3"></i>
                        Content Stats
                    </h3>
                </div>
                
                <div class="p-6 space-y-4">
                    <div class="text-center p-4 bg-kai-blue/5 rounded-lg">
                        <div class="text-2xl font-bold text-kai-blue">{{ strlen($about->deskripsi) }}</div>
                        <div class="text-sm text-gray-600">Current Characters</div>
                    </div>
                    
                    <div class="text-center p-4 bg-kai-orange/5 rounded-lg">
                        <div class="text-2xl font-bold text-kai-orange">{{ str_word_count($about->deskripsi) }}</div>
                        <div class="text-sm text-gray-600">Current Words</div>
                    </div>
                    
                    <div class="text-center p-4 bg-green-500/5 rounded-lg">
                        <div class="text-2xl font-bold text-green-500">{{ $about->tahun }}</div>
                        <div class="text-sm text-gray-600">Tahun</div>
                    </div>
                </div>
            </div>

            <!-- Timeline Preview -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-6 py-4">
                    <h3 class="text-lg font-semibold flex items-center">
                        <i class="fas fa-history mr-3"></i>
                        Timeline Preview
                    </h3>
                </div>
                
                <div class="p-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-kai-blue rounded-full flex items-center justify-center flex-shrink-0">
                                <span class="text-white font-bold text-sm">{{ substr($about->tahun, -2) }}</span>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 mb-2">{{ $about->judul }}</h4>
                                <p class="text-sm text-gray-600">{{ Str::limit($about->deskripsi, 100) }}</p>
                                <div class="mt-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-kai-blue/10 text-kai-blue">
                                        {{ $about->tahun }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-3 text-center">Preview dari how this entry will appear</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <div class="p-6 space-y-4">
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 flex items-center justify-center">
                        <i class="fas fa-save mr-2"></i>
                        Update Entry
                    </button>
                    
                    <a href="{{ route('admin.about.index') }}" 
                       class="w-full bg-gray-500 text-white py-3 px-6 rounded-lg font-medium hover:bg-gray-600 transition-colors duration-300 flex items-center justify-center">
                        <i class="fas fa-times mr-2"></i>
                        Cancel
                    </a>
                    
                    <button type="button" 
                            onclick="confirmDelete('{{ route('admin.about.destroy', $about->id) }}', 'Delete this about entry?')"
                            class="w-full bg-red-500 text-white py-3 px-6 rounded-lg font-medium hover:bg-red-600 transition-colors duration-300 flex items-center justify-center">
                        <i class="fas fa-trash mr-2"></i>
                        Delete Entry
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
<script>
    // Character counter
    const textarea = document.getElementById('deskripsi');
    const charJumlah = document.getElementById('charJumlah');
    
    function updateCharJumlah() {
        const count = textarea.value.length;
        charJumlah.textContent = `${count} characters`;
        
        if (count > 1000) {
            charJumlah.classList.add('text-red-500');
            charJumlah.classList.remove('text-gray-400');
        } else {
            charJumlah.classList.add('text-gray-400');
            charJumlah.classList.remove('text-red-500');
        }
    }
    
    textarea.addEventListener('input', updateCharJumlah);
    
    // Initialize character count
    updateCharJumlah();
    
    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
        const year = parseInt(document.getElementById('tahun').value);
        const currentTahun = new Date().getFullTahun();
        
        if (year > currentTahun + 10) {
            e.preventDefault();
            alert('Tahun cannot be more than 10 tahun in the future.');
            return false;
        }
        
        // Show loading state
        const submitBtn = document.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Updating Entry...';
        submitBtn.disabled = true;
    });
</script>
@endpush
