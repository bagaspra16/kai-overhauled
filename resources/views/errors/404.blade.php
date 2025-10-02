@extends('layouts.app')

@section('title', 'Halaman Tidak Ditemukan - KAI')
@section('description', 'Halaman yang Anda cari tidak ditemukan. Kembali ke beranda untuk melanjutkan perjalanan dengan KAI.')

@section('styles')
<style>
    .train-animation {
        animation: trainMove 12s ease-in-out infinite;
        filter: drop-shadow(0 4px 8px rgba(44, 42, 107, 0.3));
    }
    
    @keyframes trainMove {
        0% { 
            transform: translateX(-200px) scale(0.8); 
            opacity: 0;
        }
        5% { 
            transform: translateX(-150px) scale(0.9); 
            opacity: 1;
        }
        15% { 
            transform: translateX(-50px) scale(1); 
        }
        45% { 
            transform: translateX(calc(50vw - 50px)) scale(1); 
        }
        85% { 
            transform: translateX(calc(100vw + 50px)) scale(0.9); 
        }
        95% { 
            transform: translateX(calc(100vw + 150px)) scale(0.8); 
            opacity: 1;
        }
        100% { 
            transform: translateX(calc(100vw + 200px)) scale(0.8); 
            opacity: 0;
        }
    }
    
    .train-car {
        animation: trainBounce 0.5s ease-in-out infinite alternate;
    }
    
    @keyframes trainBounce {
        0% { transform: translateY(0px); }
        100% { transform: translateY(-2px); }
    }
    
    .train-smoke {
        animation: smokeRise 2s ease-out infinite;
    }
    
    @keyframes smokeRise {
        0% { 
            transform: translateY(0px) scale(0.5); 
            opacity: 0.8; 
        }
        50% { 
            transform: translateY(-20px) scale(0.8); 
            opacity: 0.4; 
        }
        100% { 
            transform: translateY(-40px) scale(1); 
            opacity: 0; 
        }
    }
    
    .train-wheel {
        animation: wheelRotate 0.3s linear infinite;
        transform-origin: center;
    }
    
    @keyframes wheelRotate {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    .cloud {
        animation: cloudFloat 20s linear infinite;
    }
    
    @keyframes cloudFloat {
        0% { transform: translateX(-100px); }
        100% { transform: translateX(calc(100vw + 100px)); }
    }
    
    .number-bounce {
        animation: numberBounce 2s ease-in-out infinite;
    }
    
    @keyframes numberBounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        60% { transform: translateY(-10px); }
    }
    
    .glitch {
        animation: glitch 2s infinite;
    }
    
    @keyframes glitch {
        0%, 100% { transform: translate(0); }
        10% { transform: translate(-2px, -2px); }
        20% { transform: translate(2px, 2px); }
        30% { transform: translate(-2px, 2px); }
        40% { transform: translate(2px, -2px); }
        50% { transform: translate(-2px, -2px); }
        60% { transform: translate(2px, 2px); }
        70% { transform: translate(-2px, 2px); }
        80% { transform: translate(2px, -2px); }
        90% { transform: translate(-2px, -2px); }
    }
    
    .particle {
        position: absolute;
        background: #eb6a28;
        border-radius: 50%;
        animation: particleFloat 3s ease-in-out infinite;
    }
    
    @keyframes particleFloat {
        0%, 100% { transform: translateY(0px) rotate(0deg); opacity: 1; }
        50% { transform: translateY(-20px) rotate(180deg); opacity: 0.5; }
    }
    
    .track-line {
        background: linear-gradient(90deg, transparent 0%, #2c2a6b 20%, #2c2a6b 80%, transparent 100%);
        height: 3px;
        animation: trackShine 4s ease-in-out infinite;
        border-radius: 2px;
        position: relative;
    }
    
    .track-line::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, transparent 0%, #ffffff 20%, #ffffff 80%, transparent 100%);
        transform: translateY(-50%);
        opacity: 0.6;
    }
    
    .track-ties {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 8px;
        background-image: repeating-linear-gradient(
            90deg,
            transparent 0px,
            transparent 15px,
            #8B4513 15px,
            #8B4513 25px,
            transparent 25px,
            transparent 40px
        );
        opacity: 0.4;
    }
    
    @keyframes trackShine {
        0%, 100% { 
            opacity: 0.4;
            filter: brightness(1);
        }
        50% { 
            opacity: 0.8;
            filter: brightness(1.2);
        }
    }
    
    .bg-gradient-radial {
        background: radial-gradient(circle, var(--tw-gradient-stops));
    }
    
    .headlight-glow {
        animation: headlightGlow 2s ease-in-out infinite alternate;
    }
    
    @keyframes headlightGlow {
        0% { 
            box-shadow: 0 0 5px rgba(255, 255, 0, 0.5);
            filter: brightness(1);
        }
        100% { 
            box-shadow: 0 0 15px rgba(255, 255, 0, 0.8), 0 0 25px rgba(255, 255, 0, 0.4);
            filter: brightness(1.2);
        }
    }
    
    .engine-steam {
        animation: steamPuff 1.5s ease-out infinite;
    }
    
    @keyframes steamPuff {
        0% { 
            transform: translateY(0px) scale(0.3); 
            opacity: 0.9; 
        }
        50% { 
            transform: translateY(-15px) scale(0.7); 
            opacity: 0.5; 
        }
        100% { 
            transform: translateY(-30px) scale(1); 
            opacity: 0; 
        }
    }
</style>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-orange-50 relative overflow-hidden flex items-center justify-center">
    <!-- Background Elements -->
    <div class="absolute inset-0 overflow-hidden">
        <!-- Animated Clouds -->
        <div class="cloud absolute top-20 opacity-20" style="animation-delay: 0s;">
            <i class="fas fa-cloud text-6xl text-gray-300"></i>
        </div>
        <div class="cloud absolute top-32 opacity-15" style="animation-delay: 5s;">
            <i class="fas fa-cloud text-4xl text-gray-300"></i>
        </div>
        <div class="cloud absolute top-40 opacity-10" style="animation-delay: 10s;">
            <i class="fas fa-cloud text-5xl text-gray-300"></i>
        </div>
        
        <!-- Floating Particles -->
        <div class="particle w-2 h-2 top-1/4 left-1/4" style="animation-delay: 0s;"></div>
        <div class="particle w-3 h-3 top-1/3 right-1/4" style="animation-delay: 1s;"></div>
        <div class="particle w-1 h-1 top-2/3 left-1/3" style="animation-delay: 2s;"></div>
        <div class="particle w-2 h-2 top-3/4 right-1/3" style="animation-delay: 0.5s;"></div>
        
        <!-- Animated Train -->
        <div class="train-animation absolute bottom-16 text-kai-blue">
            <div class="flex items-end">
                <!-- Train Cars -->
                <div class="train-car flex ml-1">
                    <!-- Car 1 -->
                    <div class="relative">
                        <div class="w-12 h-8 bg-gradient-to-b from-kai-orange to-kai-orange-light rounded-sm mr-1 shadow-md">
                            <!-- Car Windows -->
                            <div class="absolute top-1 left-1 w-2 h-2 bg-blue-100 rounded-sm opacity-80 border border-gray-300"></div>
                            <div class="absolute top-1 right-1 w-2 h-2 bg-blue-100 rounded-sm opacity-80 border border-gray-300"></div>
                            <!-- Car Door -->
                            <div class="absolute top-3 left-4 w-1 h-4 bg-kai-orange-light border-l border-gray-400"></div>
                            <!-- Car Logo -->
                            <div class="absolute top-4 left-1 w-2 h-1 bg-white rounded-sm opacity-80">
                                <div class="text-xs text-kai-orange font-bold text-center leading-none">KAI</div>
                            </div>
                        </div>
                        <!-- Car Wheels -->
                        <div class="absolute -bottom-2 left-1 flex space-x-1">
                            <div class="train-wheel w-3 h-3 bg-gray-700 rounded-full border border-gray-800 shadow-sm">
                                <div class="w-0.5 h-0.5 bg-gray-400 rounded-full mx-auto mt-1"></div>
                            </div>
                            <div class="train-wheel w-3 h-3 bg-gray-700 rounded-full border border-gray-800 shadow-sm">
                                <div class="w-0.5 h-0.5 bg-gray-400 rounded-full mx-auto mt-1"></div>
                            </div>
                        </div>
                        <!-- Car Coupling -->
                        <div class="absolute -right-0.5 top-3 w-1 h-2 bg-gray-600 rounded-sm">
                            <div class="absolute -right-0.5 top-0.5 w-0.5 h-1 bg-gray-700 rounded-full"></div>
                        </div>
                    </div>
                    
                    <!-- Car 2 -->
                    <div class="relative">
                        <div class="w-12 h-8 bg-gradient-to-b from-kai-blue to-kai-blue-light rounded-sm mr-1 shadow-md">
                            <!-- Car Windows -->
                            <div class="absolute top-1 left-1 w-2 h-2 bg-blue-100 rounded-sm opacity-80 border border-gray-300"></div>
                            <div class="absolute top-1 right-1 w-2 h-2 bg-blue-100 rounded-sm opacity-80 border border-gray-300"></div>
                            <!-- Car Door -->
                            <div class="absolute top-3 left-4 w-1 h-4 bg-kai-blue-light border-l border-gray-400"></div>
                            <!-- Car Logo -->
                            <div class="absolute top-4 left-1 w-2 h-1 bg-white rounded-sm opacity-80">
                                <div class="text-xs text-kai-blue font-bold text-center leading-none"></div>
                            </div>
                        </div>
                        <!-- Car Wheels -->
                        <div class="absolute -bottom-2 left-1 flex space-x-1">
                            <div class="train-wheel w-3 h-3 bg-gray-700 rounded-full border border-gray-800 shadow-sm">
                                <div class="w-0.5 h-0.5 bg-gray-400 rounded-full mx-auto mt-1"></div>
                            </div>
                            <div class="train-wheel w-3 h-3 bg-gray-700 rounded-full border border-gray-800 shadow-sm">
                                <div class="w-0.5 h-0.5 bg-gray-400 rounded-full mx-auto mt-1"></div>
                            </div>
                        </div>
                        <!-- Car Coupling -->
                        <div class="absolute -right-0.5 top-3 w-1 h-2 bg-gray-600 rounded-sm">
                            <div class="absolute -right-0.5 top-0.5 w-0.5 h-1 bg-gray-700 rounded-full"></div>
                        </div>
                    </div>
                    
                    <!-- Car 3 -->
                    <div class="relative">
                        <div class="w-12 h-8 bg-gradient-to-b from-kai-orange to-kai-orange-light rounded-sm shadow-md">
                            <!-- Car Windows -->
                            <div class="absolute top-1 left-1 w-2 h-2 bg-blue-100 rounded-sm opacity-80 border border-gray-300"></div>
                            <div class="absolute top-1 right-1 w-2 h-2 bg-blue-100 rounded-sm opacity-80 border border-gray-300"></div>
                            <!-- Car Door -->
                            <div class="absolute top-3 left-4 w-1 h-4 bg-kai-orange-light border-l border-gray-400"></div>
                            <!-- Car Logo -->
                            <div class="absolute top-4 left-1 w-2 h-1 bg-white rounded-sm opacity-80">
                                <div class="text-xs text-kai-orange font-bold text-center leading-none"></div>
                            </div>
                        </div>
                        <!-- Car Wheels -->
                        <div class="absolute -bottom-2 left-1 flex space-x-1">
                            <div class="train-wheel w-3 h-3 bg-gray-700 rounded-full border border-gray-800 shadow-sm">
                                <div class="w-0.5 h-0.5 bg-gray-400 rounded-full mx-auto mt-1"></div>
                            </div>
                            <div class="train-wheel w-3 h-3 bg-gray-700 rounded-full border border-gray-800 shadow-sm">
                                <div class="w-0.5 h-0.5 bg-gray-400 rounded-full mx-auto mt-1"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Train Engine -->
                <div class="relative">

                    <!-- Car Coupling -->
                    <div class="absolute -left-0.5 top-3 w-1 h-2 bg-gray-600 rounded-sm">
                        <div class="absolute -right-0.5 top-0.5 w-0.5 h-1 bg-gray-700 rounded-full"></div>
                    </div>
                    
                    <!-- Engine Body -->
                    <div class="w-16 h-10 bg-gradient-to-b from-kai-blue to-kai-blue-light rounded-t-lg rounded-bl-lg relative shadow-lg">
                        <!-- Engine Nose/Front (Streamlined) -->
                        <div class="absolute -right-3 top-1 w-5 h-8 bg-gradient-to-l from-kai-blue-light to-kai-blue rounded-r-full transform -skew-y-1"></div>
                        
                        <!-- Engine Cowcatcher (Pembersih Rel) -->
                        <div class="absolute -right-4 bottom-0 w-4 h-2 bg-gray-600 transform skew-x-12 rounded-r-sm"></div>
                        
                        <!-- Engine Pilot (Bumper Depan) -->
                        <div class="absolute -right-2 bottom-1 w-3 h-1 bg-gray-700 rounded-r-full"></div>
                        
                        <!-- Main Headlight -->
                        <div class="absolute -right-2 top-3 w-3 h-3 bg-gradient-radial from-yellow-200 to-yellow-500 rounded-full headlight-glow shadow-lg">
                            <div class="absolute inset-0.5 bg-yellow-100 rounded-full opacity-80"></div>
                            <div class="absolute inset-1 bg-white rounded-full opacity-60"></div>
                        </div>
                        
                        <!-- Secondary Lights -->
                        <div class="absolute -right-1 top-1 w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse opacity-80"></div>
                        <div class="absolute -right-1 top-6 w-1.5 h-1.5 bg-red-500 rounded-full animate-pulse opacity-80" style="animation-delay: 0.5s;"></div>
                        
                        <!-- Engine Cab Window -->
                        <div class="absolute top-1 right-2 w-5 h-4 bg-gradient-to-b from-blue-100 to-blue-200 rounded-sm opacity-90 shadow-inner">
                            <!-- Window Frame -->
                            <div class="absolute inset-0 border border-gray-400 rounded-sm"></div>
                            <!-- Window Reflection -->
                            <div class="absolute top-0 right-0 w-2 h-2 bg-white opacity-40 rounded-sm"></div>
                        </div>
                        
                        <!-- Engine Side Vents -->
                        <div class="absolute top-6 right-1 w-3 h-1 bg-gray-600 rounded-sm opacity-80"></div>
                        <div class="absolute top-7 right-1 w-3 h-0.5 bg-gray-600 rounded-sm opacity-60"></div>
                        
                        <!-- Engine Number Plate -->
                        <div class="absolute top-5 right-3 w-4 h-2 bg-white rounded-sm border border-gray-300">
                            <div class="text-xs text-kai-blue font-bold text-center leading-none pt-0.5">404</div>
                        </div>
                        
                        <!-- Engine Horn -->
                        <div class="absolute top-0 right-6 w-1 h-2 bg-gray-700 rounded-t-full"></div>
                        <div class="absolute top-0 right-7 w-1 h-1.5 bg-gray-700 rounded-t-full"></div>
                        
                        <!-- Pantograph (for electric trains) -->
                        <div class="absolute -top-2 right-8 w-3 h-1 bg-gray-600 transform -rotate-12">
                            <div class="absolute -top-1 left-0 w-0.5 h-2 bg-gray-500 transform rotate-45"></div>
                            <div class="absolute -top-1 right-0 w-0.5 h-2 bg-gray-500 transform -rotate-45"></div>
                        </div>
                    </div>
                    
                    <!-- Engine Wheels -->
                    <div class="absolute -bottom-2 right-1 flex space-x-2">
                        <div class="train-wheel w-4 h-4 bg-gray-700 rounded-full border-2 border-gray-800">
                            <div class="w-1 h-1 bg-gray-400 rounded-full mx-auto mt-1.5"></div>
                        </div>
                        <div class="train-wheel w-4 h-4 bg-gray-700 rounded-full border-2 border-gray-800">
                            <div class="w-1 h-1 bg-gray-400 rounded-full mx-auto mt-1.5"></div>
                        </div>
                    </div>
                    
                    <!-- Engine Steam/Smoke -->
                    <div class="absolute -top-8 right-6">
                        <div class="engine-steam w-4 h-4 bg-gray-400 rounded-full opacity-70" style="animation-delay: 0s;"></div>
                    </div>
                    <div class="absolute -top-6 right-8">
                        <div class="engine-steam w-3 h-3 bg-gray-300 rounded-full opacity-50" style="animation-delay: 0.4s;"></div>
                    </div>
                    <div class="absolute -top-4 right-10">
                        <div class="engine-steam w-2 h-2 bg-gray-200 rounded-full opacity-30" style="animation-delay: 0.8s;"></div>
                    </div>
                    <div class="absolute -top-2 right-12">
                        <div class="engine-steam w-1 h-1 bg-gray-100 rounded-full opacity-20" style="animation-delay: 1.2s;"></div>
                    </div>
                </div>
                
                <!-- Engine Coupling -->
                <div class="absolute right-0 top-4 w-2 h-2 bg-gray-600 rounded-sm">
                    <div class="absolute -right-1 top-0.5 w-1 h-1 bg-gray-700 rounded-full"></div>
                </div>
                    </div>
            </div>
        </div>

        <!-- Railway Tracks -->
        <div class="absolute bottom-14 left-0 right-0">
            <!-- Track Ties (Bantalan Rel) -->
            <div class="track-ties"></div>
            
            <!-- Rails -->
            <div class="relative">
                <div class="track-line" style="animation-delay: 1.5s; bottom: 2px;"></div>
            </div>
        </div>
    </div>
    
    <!-- Main Content -->
    <div class="relative z-10 text-center px-4 max-w-4xl mx-auto" x-data="{ 
        isVisible: false,
        searchQuery: '',
        suggestions: [
            'Beranda',
            'Tentang KAI', 
            'Layanan Kereta',
            'Berita Terbaru',
            'Kontak Kami',
            'Jadwal Kereta',
            'Tiket Online'
        ],
        showSuggestions: false
    }" x-init="setTimeout(() => isVisible = true, 500)">
        
        <!-- 404 Number with Animation -->
        <div class="mb-8" x-show="isVisible" x-transition:enter="transition ease-out duration-1000" x-transition:enter-start="opacity-0 scale-50" x-transition:enter-end="opacity-100 scale-100">
            <div class="flex justify-center items-center space-x-4">
                <span class="text-9xl md:text-[12rem] font-black text-kai-blue number-bounce glitch" style="animation-delay: 0s;">4</span>
                <div class="relative">
                    <span class="text-9xl md:text-[12rem] font-black text-kai-orange number-bounce" style="animation-delay: 0.2s;">0</span>
                    <div class="absolute inset-0 text-9xl md:text-[12rem] font-black text-kai-orange opacity-50 animate-ping"></div>
                </div>
                <span class="text-9xl md:text-[12rem] font-black text-kai-blue number-bounce glitch" style="animation-delay: 0.4s;">4</span>
            </div>
        </div>
        
        <!-- Error Message -->
        <div class="mb-8" x-show="isVisible" x-transition:enter="transition ease-out duration-1000 delay-300" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            <h1 class="text-4xl md:text-6xl font-bold text-kai-blue mb-4 animate-pulse">
                Stasiun Tidak Ditemukan!
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 mb-2 animate-fade-in">
                Maaf, kereta Anda tersesat di jalur yang salah
            </p>
            <p class="text-lg text-gray-500 animate-fade-in" style="animation-delay: 0.5s;">
                Halaman yang Anda cari mungkin telah dipindahkan, dihapus, atau tidak pernah ada
            </p>
        </div>
        
        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8" x-show="isVisible" x-transition:enter="transition ease-out duration-1000 delay-700" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            <a href="{{ route('home') }}" 
               class="group relative px-8 py-4 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white font-bold rounded-full hover:from-kai-blue-light hover:to-kai-blue transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl">
                <span class="relative z-10 flex items-center">
                    <i class="fas fa-home mr-3 group-hover:animate-bounce"></i>
                    Kembali ke Beranda
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
            </a>
            
            <button onclick="history.back()" 
                    class="group relative px-8 py-4 bg-gradient-to-r from-kai-orange to-kai-orange-light text-white font-bold rounded-full hover:from-kai-orange-light hover:to-kai-orange transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 shadow-lg hover:shadow-2xl">
                <span class="relative z-10 flex items-center">
                    <i class="fas fa-arrow-left mr-3 group-hover:animate-bounce"></i>
                    Halaman Sebelumnya
                </span>
                <div class="absolute inset-0 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
            </button>
        </div>
        
        <!-- Quick Links -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-2xl mx-auto" x-show="isVisible" x-transition:enter="transition ease-out duration-1000 delay-900" x-transition:enter-start="opacity-0 translate-y-8" x-transition:enter-end="opacity-100 translate-y-0">
            <a href="{{ route('about') }}" 
               class="group p-6 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 border border-gray-200 hover:border-kai-orange/50">
                <div class="text-kai-blue group-hover:text-kai-orange transition-colors duration-300 mb-3">
                    <i class="fas fa-info-circle text-3xl group-hover:animate-bounce"></i>
                </div>
                <h3 class="font-bold text-gray-800 group-hover:text-kai-blue transition-colors duration-300">Tentang KAI</h3>
            </a>
            
            <a href="{{ route('services') }}" 
               class="group p-6 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 border border-gray-200 hover:border-kai-orange/50">
                <div class="text-kai-blue group-hover:text-kai-orange transition-colors duration-300 mb-3">
                    <i class="fas fa-subway text-3xl group-hover:animate-bounce"></i>
                </div>
                <h3 class="font-bold text-gray-800 group-hover:text-kai-blue transition-colors duration-300">Layanan</h3>
            </a>
            
            <a href="{{ route('news') }}" 
               class="group p-6 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 border border-gray-200 hover:border-kai-orange/50">
                <div class="text-kai-blue group-hover:text-kai-orange transition-colors duration-300 mb-3">
                    <i class="fas fa-newspaper text-3xl group-hover:animate-bounce"></i>
                </div>
                <h3 class="font-bold text-gray-800 group-hover:text-kai-blue transition-colors duration-300">Berita</h3>
            </a>
            
            <a href="{{ route('contact') }}" 
               class="group p-6 bg-white/80 backdrop-blur-sm rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:scale-105 hover:-translate-y-2 border border-gray-200 hover:border-kai-orange/50">
                <div class="text-kai-blue group-hover:text-kai-orange transition-colors duration-300 mb-3">
                    <i class="fas fa-envelope text-3xl group-hover:animate-bounce"></i>
                </div>
                <h3 class="font-bold text-gray-800 group-hover:text-kai-blue transition-colors duration-300">Kontak</h3>
            </a>
        </div>
        
        <!-- Fun Facts -->
        <div class="mt-12 relative max-w-2xl mx-auto" x-data="{ showFunFacts: false }" x-init="setTimeout(() => showFunFacts = true, 1100)">
            <div x-show="showFunFacts" 
                 x-transition:enter="transition ease-out duration-1000" 
                 x-transition:enter-start="opacity-0 translate-y-8" 
                 x-transition:enter-end="opacity-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 scale-100"
                 x-transition:leave-end="opacity-0 scale-95"
                 class="relative p-6 bg-white/60 backdrop-blur-sm rounded-2xl shadow-lg border border-gray-200">
                
                <!-- Close Button -->
                <button @click="showFunFacts = false" 
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors duration-200">
                    <i class="fas fa-times text-lg"></i>
                </button>
                
                <h3 class="text-xl font-bold text-kai-blue mb-4 flex items-center justify-center pr-8">
                    <i class="fas fa-lightbulb text-kai-orange mr-3 animate-pulse"></i>
                    Tahukah Anda?
                </h3>
                <p class="text-gray-600 text-center" x-data="{ 
                    facts: [
                        'KAI melayani lebih dari 300 juta penumpang setiap tahunnya',
                        'Kereta api adalah transportasi yang paling ramah lingkungan',
                        'KAI memiliki jalur kereta api sepanjang lebih dari 5.000 km',
                        'Kereta cepat Jakarta-Bandung dapat mencapai kecepatan 350 km/jam'
                    ],
                    currentFact: 0
                }" x-init="setInterval(() => currentFact = (currentFact + 1) % facts.length, 3000)">
                    <span x-text="facts[currentFact]" class="animate-fade-in"></span>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add some interactive particles on mouse move
    document.addEventListener('mousemove', function(e) {
        if (Math.random() > 0.95) {
            createParticle(e.clientX, e.clientY);
        }
    });
    
    function createParticle(x, y) {
        const particle = document.createElement('div');
        particle.className = 'absolute w-1 h-1 bg-kai-orange rounded-full pointer-events-none';
        particle.style.left = x + 'px';
        particle.style.top = y + 'px';
        particle.style.animation = 'particleFloat 2s ease-out forwards';
        document.body.appendChild(particle);
        
        setTimeout(() => {
            particle.remove();
        }, 2000);
    }
    
    // Add keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Enter') {
            window.location.href = '{{ route("home") }}';
        } else if (e.key === 'Escape') {
            history.back();
        }
    });
    
});
</script>
@endsection
