@extends('admin.layouts.app')

@section('title', 'Lihat Profil Perusahaan')

@section('content')
<!-- Page Header -->
<div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8">
    <div>
        <h1 class="text-3xl font-bold text-kai-blue mb-2 flex items-center">
            <i class="fas fa-eye mr-3 text-kai-orange"></i>
            Lihat Profil Perusahaan
        </h1>
        <p class="text-gray-600">Detail profil perusahaan</p>
    </div>
    <div class="flex space-x-3 mt-4 sm:mt-0">
        <a href="{{ route('admin.profiles.index') }}" 
           class="flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-all duration-300">
            <i class="fas fa-arrow-left mr-2"></i>
            Back to List
        </a>
        <a href="{{ route('admin.profiles.edit', $profile->id) }}" 
           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
            <i class="fas fa-edit mr-2"></i>
            Edit Profil
        </a>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <!-- Main Content -->
    <div class="lg:col-span-2">
        <!-- Company Header -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-8">
            <div class="bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-8 py-8 text-center">
                <div class="mb-6">
                    <div class="w-32 h-32 bg-white/20 rounded-full flex items-center justify-center mx-auto border-4 border-white/20">
                        <i class="fas fa-building text-white text-5xl"></i>
                    </div>
                </div>
                <h1 class="text-3xl font-bold mb-2">{{ $profile->nama_perusahaan }}</h1>
                <p class="text-xl text-white/90 mb-4">{{ $profile->slogan }}</p>
                <div class="inline-flex items-center px-4 py-2 rounded-full bg-white/20 text-white">
                    <i class="fas fa-briefcase mr-2"></i>
                    Company Profile
                </div>
            </div>
        </div>

        <!-- Company Information -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-user-circle mr-3"></i>
                    Informasi Perusahaan
                </h3>
            </div>
            <div class="p-8">
                <div class="space-y-6">
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-eye mr-2 text-kai-blue"></i>
                            Visi
                        </h4>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->visi }}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-target mr-2 text-kai-orange"></i>
                            Misi
                        </h4>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->misi }}</p>
                    </div>
                    
                    <div class="bg-gray-50 rounded-lg p-6">
                        <h4 class="font-semibold text-gray-900 mb-3 flex items-center">
                            <i class="fas fa-map-marker-alt mr-2 text-green-500"></i>
                            Alamat
                        </h4>
                        <p class="text-gray-700 leading-relaxed">{{ $profile->alamat }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div class="space-y-6">
        <!-- Company Details -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-purple-500 to-purple-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-id-card mr-3"></i>
                    Company Details
                </h3>
            </div>
            <div class="p-6 space-y-4">
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Nama Perusahaan</span>
                    <span class="font-medium text-right">{{ $profile->nama_perusahaan }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Slogan</span>
                    <span class="font-medium text-right">{{ $profile->slogan }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Email</span>
                    <span class="font-medium text-right">{{ $profile->email }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Telepon</span>
                    <span class="font-medium text-right">{{ $profile->telepon }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Created</span>
                    <span class="font-medium">{{ $profile->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <span class="text-gray-600">Updated</span>
                    <span class="font-medium">{{ $profile->updated_at->format('M d, Y') }}</span>
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
                <a href="{{ route('admin.profiles.edit', $profile->id) }}" 
                   class="flex items-center w-full p-3 bg-kai-blue text-white rounded-lg hover:bg-kai-blue-light transition-colors duration-300">
                    <i class="fas fa-edit mr-3"></i>
                    Edit Company Profile
                </a>
                
                <button onclick="shareProfile()" 
                        class="flex items-center w-full p-3 bg-kai-orange text-white rounded-lg hover:bg-kai-orange-light transition-colors duration-300">
                    <i class="fas fa-share-alt mr-3"></i>
                    Share Company
                </button>
                
                <button onclick="printProfile()" 
                        class="flex items-center w-full p-3 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors duration-300">
                    <i class="fas fa-print mr-3"></i>
                    Print Company
                </button>
                
                <button onclick="confirmDelete('{{ route('admin.profiles.destroy', $profile->id) }}', 'Delete this profile?')" 
                        class="flex items-center w-full p-3 bg-red-500 text-white rounded-lg hover:bg-red-600 transition-colors duration-300">
                    <i class="fas fa-trash mr-3"></i>
                    Delete Company
                </button>
            </div>

        <!-- Company Card Preview -->
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-6 py-4">
                <h3 class="text-lg font-semibold flex items-center">
                    <i class="fas fa-eye mr-3"></i>
                    Public Preview
                </h3>
            </div>
            <div class="p-6">
                <div class="bg-gray-50 rounded-lg p-6 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-kai-blue to-kai-blue-light rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-building text-white text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-900 mb-1">{{ $profile->nama_perusahaan }}</h4>
                    <p class="text-sm text-kai-blue font-medium mb-2">{{ $profile->slogan }}</p>
                    <div class="text-xs text-gray-600 space-y-1">
                        <p><i class="fas fa-envelope mr-1"></i>{{ $profile->email }}</p>
                        <p><i class="fas fa-phone mr-1"></i>{{ $profile->telepon }}</p>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-3 text-center">This is how the company appears to users</p>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Share profile
    function shareProfile() {
        if (navigator.share) {
            navigator.share({
                title: '{{ $profile->nama }} - {{ $profile->jabatan }}',
                text: '{{ Str::limit($profile->deskripsi, 100) }}',
                url: window.location.href
            });
        } else {
            navigator.clipboard.writeText(window.location.href).then(function() {
                alert('Profile URL copied to clipboard!');
            });
        }
    }

    // Print profile
    function printProfile() {
        window.print();
    }
</script>
@endpush
