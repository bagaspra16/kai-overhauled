@extends('admin.layouts.app')

@section('title', 'Lihat Entri Tentang')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-eye mr-3 text-kai-orange"></i>
            Lihat Entri Tentang
        </h1>
        <p class="text-gray-600">Informasi dan sejarah perusahaan details</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.about.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.about.edit', $about->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-edit mr-2"></i>
            Edit Entry
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Entry Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-8 py-8 text-center">
                <div class="w-24 h-24 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-info-circle text-white text-4xl"></i>
                </div>
                <h1 class="text-3xl font-bold mb-4">{{ $about->judul }}</h1>
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 text-white">
                    <i class="fas fa-calendar mr-2"></i>
                    Tahun {{ $about->tahun }}
                </div>
            </div>
        </div>

        <!-- Description Content -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-file-alt mr-3"></i>
                    Description
                </h3>
            </div>
            <div class="p-8">
                <div class="prose max-w-none">
                    <p class="text-gray-700 leading-relaxed text-lg">{!! nl2br(e($about->deskripsi)) !!}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Entry Details -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-info-circle mr-3"></i>
                    Entry Details
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Entry ID</span>
                    <span class="font-mono text-kai-blue">#{{ $about->id }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Judul</span>
                    <span class="font-medium text-right">{{ Str::limit($about->judul, 20) }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Tahun</span>
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

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-bolt mr-3"></i>
                    Quick Actions
                </h3>
            </div>
            <div class="p-6 space-y-3">
                <a href="{{ route('admin.about.edit', $about->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Entry
                </a>
                
                <button onclick="shareEntry()" 
                        class="flex items-center w-full p-3 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                    <i class="fas fa-share-alt mr-3"></i>
                    Share Entry
                </button>
                
                <button onclick="printEntry()" 
                        class="flex items-center w-full p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                    <i class="fas fa-print mr-3"></i>
                    Print Entry
                </button>
                
                <button onclick="confirmDelete('{{ route('admin.about.destroy', $about->id) }}', 'Delete this about entry?')" 
                        class="flex items-center w-full p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-trash mr-3"></i>
                    Delete Entry
                </button>
            </div>
        </div>

        <!-- Content Statistik -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-chart-bar mr-3"></i>
                    Content Statistik
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="text-center p-4 bg-kai-blue/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-blue">{{ strlen($about->deskripsi) }}</div>
                    <div class="text-sm text-gray-600">Characters</div>
                </div>
                
                <div class="text-center p-4 bg-kai-orange/5 rounded-lg">
                    <div class="text-2xl font-bold text-kai-orange">{{ str_word_count($about->deskripsi) }}</div>
                    <div class="text-sm text-gray-600">Words</div>
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
                    Timeline Entry
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
                <p class="text-xs text-gray-500 mt-3 text-center">This is how the entry appears in timeline view</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Share entry
    function shareEntry() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $about->judul }} ({{ $about->tahun }})',
                text: '{{ Str::limit($about->deskripsi, 100) }}',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Entry URL copied to clipboard!');
            });
        }
    }

    // Print entry
    function printEntry() {
        window.print();
    }
</script>
@endpush
