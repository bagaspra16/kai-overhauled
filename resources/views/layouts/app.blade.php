<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'PT Kereta Api Indonesia (KAI)')</title>
    <meta name="description" content="@yield('description', 'PT Kereta Api Indonesia - Menghubungkan Nusantara dengan Layanan Transportasi Kereta Api Terbaik')">
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom Tailwind Config -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'kai-blue': '#2c2a6b',
                        'kai-orange': '#eb6a28',
                        'kai-white': '#ffffff',
                        'kai-blue-light': '#3d3b7a',
                        'kai-orange-light': '#ff7c47'
                    },
                    fontFamily: {
                        'inter': ['Inter', 'sans-serif'],
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.5s ease-in-out',
                        'slide-up': 'slideUp 0.6s ease-out',
                        'slide-down': 'slideDown 0.6s ease-out',
                        'scale-in': 'scaleIn 0.4s ease-out',
                        'bounce-slow': 'bounce 2s infinite',
                        'pulse-slow': 'pulse 3s infinite',
                        'float': 'float 3s ease-in-out infinite',
                        'gradient': 'gradient 15s ease infinite',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': { opacity: '0' },
                            '100%': { opacity: '1' },
                        },
                        slideUp: {
                            '0%': { transform: 'translateY(20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        slideDown: {
                            '0%': { transform: 'translateY(-20px)', opacity: '0' },
                            '100%': { transform: 'translateY(0)', opacity: '1' },
                        },
                        scaleIn: {
                            '0%': { transform: 'scale(0.9)', opacity: '0' },
                            '100%': { transform: 'scale(1)', opacity: '1' },
                        },
                        float: {
                            '0%, 100%': { transform: 'translateY(0px)' },
                            '50%': { transform: 'translateY(-10px)' },
                        },
                        gradient: {
                            '0%, 100%': { backgroundPosition: '0% 50%' },
                            '50%': { backgroundPosition: '100% 50%' },
                        }
                    },
                    backgroundSize: {
                        '300%': '300% 300%',
                    }
                }
            }
        }
    </script>
    
    <!-- Custom Scrollbar Styles -->
    <style>
        /* Webkit Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(75, 85, 99, 0.3);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(75, 85, 99, 0.5);
        }
        
        /* Firefox Scrollbar */
        html {
            scrollbar-width: thin;
            scrollbar-color: rgba(75, 85, 99, 0.3) transparent;
        }
        
        /* Select2 Custom Styles */
        .select2-container--default .select2-selection--single {
            height: 56px !important;
            border: 1px solid #d1d5db !important;
            border-radius: 12px !important;
            padding: 0 16px !important;
            background: white !important;
            box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            transition: all 0.3s ease !important;
        }
        
        .select2-container--default .select2-selection--single:hover {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1) !important;
        }
        
        .select2-container--default .select2-selection--single:focus {
            border-color: #2c2a6b !important;
            box-shadow: 0 0 0 2px rgba(44, 42, 107, 0.2) !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 54px !important;
            padding-left: 0 !important;
            color: #374151 !important;
            font-size: 16px !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 54px !important;
            right: 16px !important;
        }
        
        .select2-container--default .select2-selection--single .select2-selection__arrow b {
            border-color: #6b7280 transparent transparent transparent !important;
            border-width: 6px 6px 0 6px !important;
        }
        
        .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
            border-color: transparent transparent #6b7280 transparent !important;
            border-width: 0 6px 6px 6px !important;
        }
        
        .select2-dropdown {
            border: 1px solid #d1d5db !important;
            border-radius: 12px !important;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05) !important;
            margin-top: 4px !important;
        }
        
        .select2-container--default .select2-results__option {
            padding: 12px 16px !important;
            color: #374151 !important;
            font-size: 16px !important;
        }
        
        .select2-container--default .select2-results__option--highlighted[aria-selected] {
            background-color: #2c2a6b !important;
            color: white !important;
        }
        
        .select2-container--default .select2-results__option[aria-selected=true] {
            background-color: #eb6a28 !important;
            color: white !important;
        }
        
        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: 1px solid #d1d5db !important;
            border-radius: 8px !important;
            padding: 8px 12px !important;
            margin: 8px !important;
            font-size: 16px !important;
        }
        
        .select2-container--default .select2-results__option .select2-results__group {
            padding: 8px 16px !important;
            font-weight: 600 !important;
            color: #2c2a6b !important;
            background-color: #f9fafb !important;
            border-bottom: 1px solid #e5e7eb !important;
        }
    </style>
    
    @yield('styles')
</head>
<body class="bg-kai-white text-gray-800 font-inter antialiased overflow-x-hidden" x-data="{ 
    isLoading: true, 
    scrollY: 0,
    isScrolled: false,
    init() {
        this.isLoading = false;
        window.addEventListener('scroll', () => {
            this.scrollY = window.scrollY;
            this.isScrolled = this.scrollY > 50;
        });
    }
}" x-init="setTimeout(() => isLoading = false, 1000)">
        <!-- Loading Screen -->
        <div x-show="isLoading" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-100" x-transition:enter-end="opacity-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-kai-blue z-50 flex items-center justify-center">
            <div class="text-center">
                <div class="relative">
                    <img src="{{ asset('logo.png') }}" alt="KAI Logo" class="w-20 h-20 mx-auto mb-4 animate-pulse object-contain">
                    <div class="text-kai-white text-xl font-bold animate-pulse">KAI</div>
                </div>
                <div class="text-kai-white mt-4 animate-bounce">Loading...</div>
            </div>
        </div>

    <!-- Header/Navbar -->
    <header class="fixed top-0 left-0 right-0 z-40 transition-all duration-300" 
            :class="isScrolled ? 'bg-kai-blue/95 backdrop-blur-md shadow-2xl' : 'bg-transparent'"
            x-data="{ mobileMenuOpen: false }">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <!-- Logo -->
                <div class="flex items-center group cursor-pointer">
                    <div class="relative">
                        <div class="text-kai-white text-3xl font-bold group-hover:scale-110 transition-transform duration-300 flex items-center">
                            <img src="{{ asset('logo-background-2.png') }}" alt="KAI Logo" class="w-10 h-10 mr-3 object-contain">
                        </div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-kai-orange to-kai-blue rounded-lg blur opacity-20 group-hover:opacity-50 transition duration-300"></div>
                    </div>
                </div>
                
                <!-- Desktop Menu -->
                <div class="hidden lg:flex space-x-2">
                    <a href="{{ route('home') }}" 
                       class="relative px-6 py-3 text-kai-white hover:text-kai-orange transition-all duration-300 rounded-full group {{ request()->routeIs('home') ? 'text-kai-orange bg-white/10' : '' }}">
                        <span class="relative z-10 font-medium">Beranda</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
                    </a>
                    <a href="{{ route('about') }}" 
                       class="relative px-6 py-3 text-kai-white hover:text-kai-orange transition-all duration-300 rounded-full group {{ request()->routeIs('about') ? 'text-kai-orange bg-white/10' : '' }}">
                        <span class="relative z-10 font-medium">Tentang</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
                    </a>
                    <a href="{{ route('services') }}" 
                       class="relative px-6 py-3 text-kai-white hover:text-kai-orange transition-all duration-300 rounded-full group {{ request()->routeIs('services') ? 'text-kai-orange bg-white/10' : '' }}">
                        <span class="relative z-10 font-medium">Layanan</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
                    </a>
                    <a href="{{ route('news') }}" 
                       class="relative px-6 py-3 text-kai-white hover:text-kai-orange transition-all duration-300 rounded-full group {{ request()->routeIs('news*') ? 'text-kai-orange bg-white/10' : '' }}">
                        <span class="relative z-10 font-medium">Berita</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
                    </a>
                    <a href="{{ route('ticket.search') }}" 
                       class="relative px-6 py-3 text-kai-white hover:text-kai-orange transition-all duration-300 rounded-full group {{ request()->routeIs('ticket.*') ? 'text-kai-orange bg-white/10' : '' }}">
                        <span class="relative z-10 font-medium">Cari Tiket</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="relative px-6 py-3 text-kai-white hover:text-kai-orange transition-all duration-300 rounded-full group {{ request()->routeIs('contact') ? 'text-kai-orange bg-white/10' : '' }}">
                        <span class="relative z-10 font-medium">Kontak</span>
                        <div class="absolute inset-0 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full scale-0 group-hover:scale-100 transition-transform duration-300 opacity-20"></div>
                    </a>
                </div>
                
                <!-- Mobile Menu Button -->
                <button @click="mobileMenuOpen = !mobileMenuOpen" 
                        class="lg:hidden text-kai-white p-2 rounded-lg hover:bg-white/10 transition-colors duration-300">
                    <i class="fas fa-bars text-xl" :class="mobileMenuOpen ? 'fa-times' : 'fa-bars'"></i>
                </button>
            </div>
            
            <!-- Mobile Menu -->
            <div x-show="mobileMenuOpen" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 transform -translate-y-4"
                 x-transition:enter-end="opacity-100 transform translate-y-0"
                 x-transition:leave="transition ease-in duration-200"
                 x-transition:leave-start="opacity-100 transform translate-y-0"
                 x-transition:leave-end="opacity-0 transform -translate-y-4"
                 class="lg:hidden mt-4 pb-4">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 space-y-2">
                    <a href="{{ route('home') }}" 
                       class="block px-4 py-3 text-kai-white hover:text-kai-orange hover:bg-white/10 transition-all duration-300 rounded-lg {{ request()->routeIs('home') ? 'text-kai-orange bg-white/10' : '' }}">
                        <i class="fas fa-home mr-3"></i>Beranda
                    </a>
                    <a href="{{ route('about') }}" 
                       class="block px-4 py-3 text-kai-white hover:text-kai-orange hover:bg-white/10 transition-all duration-300 rounded-lg {{ request()->routeIs('about') ? 'text-kai-orange bg-white/10' : '' }}">
                        <i class="fas fa-info-circle mr-3"></i>Tentang
                    </a>
                        <a href="{{ route('services') }}" 
                           class="block px-4 py-3 text-kai-white hover:text-kai-orange hover:bg-white/10 transition-all duration-300 rounded-lg {{ request()->routeIs('services') ? 'text-kai-orange bg-white/10' : '' }}">
                           <i class="fas fa-subway mr-3"></i>Layanan
                        </a>
                    <a href="{{ route('news') }}" 
                       class="block px-4 py-3 text-kai-white hover:text-kai-orange hover:bg-white/10 transition-all duration-300 rounded-lg {{ request()->routeIs('news*') ? 'text-kai-orange bg-white/10' : '' }}">
                        <i class="fas fa-newspaper mr-3"></i>Berita
                    </a>
                    <a href="{{ route('ticket.search') }}" 
                       class="block px-4 py-3 text-kai-white hover:text-kai-orange hover:bg-white/10 transition-all duration-300 rounded-lg {{ request()->routeIs('ticket.*') ? 'text-kai-orange bg-white/10' : '' }}">
                        <i class="fas fa-ticket-alt mr-3"></i>Cari Tiket
                    </a>
                    <a href="{{ route('contact') }}" 
                       class="block px-4 py-3 text-kai-white hover:text-kai-orange hover:bg-white/10 transition-all duration-300 rounded-lg {{ request()->routeIs('contact') ? 'text-kai-orange bg-white/10' : '' }}">
                        <i class="fas fa-envelope mr-3"></i>Kontak
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="relative bg-gradient-to-br from-kai-blue via-kai-blue-light to-kai-blue text-kai-white overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="relative z-10 container mx-auto px-4 py-16">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="col-span-1 md:col-span-2">
                    <div class="flex items-center mb-6 group">
                        <div class="relative">
                            <div class="text-3xl font-bold group-hover:scale-110 transition-transform duration-300 flex items-center">
                                <img src="{{ asset('logo-background-2.png') }}" alt="KAI Logo" class="w-12 h-12 mr-4 object-contain">
                                PT Kereta Api Indonesia
                            </div>
                            <div class="absolute -inset-1 bg-gradient-to-r from-kai-white to-kai-white-light rounded-lg blur opacity-20 group-hover:opacity-50 transition duration-300"></div>
                        </div>
                    </div>
                    <p class="text-gray-300 mb-6 text-lg leading-relaxed">
                        Menghubungkan Nusantara dengan layanan transportasi kereta api yang aman, nyaman, dan terpercaya. Kami berkomitmen memberikan pengalaman perjalanan terbaik untuk seluruh masyarakat Indonesia.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="group relative p-3 bg-white/10 backdrop-blur-sm rounded-full hover:bg-kai-orange transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <i class="fab fa-facebook-f text-xl group-hover:text-white transition-colors duration-300"></i>
                            <div class="absolute -inset-1 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        </a>
                        <a href="#" class="group relative p-3 bg-white/10 backdrop-blur-sm rounded-full hover:bg-kai-orange transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <i class="fab fa-twitter text-xl group-hover:text-white transition-colors duration-300"></i>
                            <div class="absolute -inset-1 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        </a>
                        <a href="#" class="group relative p-3 bg-white/10 backdrop-blur-sm rounded-full hover:bg-kai-orange transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <i class="fab fa-instagram text-xl group-hover:text-white transition-colors duration-300"></i>
                            <div class="absolute -inset-1 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        </a>
                        <a href="#" class="group relative p-3 bg-white/10 backdrop-blur-sm rounded-full hover:bg-kai-orange transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <i class="fab fa-youtube text-xl group-hover:text-white transition-colors duration-300"></i>
                            <div class="absolute -inset-1 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        </a>
                        <a href="#" class="group relative p-3 bg-white/10 backdrop-blur-sm rounded-full hover:bg-kai-orange transition-all duration-300 transform hover:scale-110 hover:-translate-y-1">
                            <i class="fab fa-tiktok text-xl group-hover:text-white transition-colors duration-300"></i>
                            <div class="absolute -inset-1 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-50 transition duration-300"></div>
                        </a>
                    </div>
                </div>
                
                <!-- Quick Links -->
                <div>
                    <h3 class="text-xl font-bold mb-6 relative">
                        <span class="relative z-10">Menu Cepat</span>
                        <div class="absolute -bottom-2 left-0 w-12 h-1 bg-kai-orange rounded-full"></div>
                    </h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-kai-orange transition-all duration-300 flex items-center group">
                            <i class="fas fa-home mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                            Beranda
                        </a></li>
                        <li><a href="{{ route('about') }}" class="text-gray-300 hover:text-kai-orange transition-all duration-300 flex items-center group">
                            <i class="fas fa-info-circle mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                            Tentang KAI
                        </a></li>
                            <li><a href="{{ route('services') }}" class="text-gray-300 hover:text-kai-orange transition-all duration-300 flex items-center group">
                            <i class="fas fa-subway mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                                Layanan
                            </a></li>
                        <li><a href="{{ route('news') }}" class="text-gray-300 hover:text-kai-orange transition-all duration-300 flex items-center group">
                            <i class="fas fa-newspaper mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                            Berita
                        </a></li>
                        <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-kai-orange transition-all duration-300 flex items-center group">
                            <i class="fas fa-envelope mr-3 group-hover:scale-110 transition-transform duration-300"></i>
                            Kontak
                        </a></li>
                    </ul>
                </div>
                
                <!-- Contact Info -->
                <div>
                    <h3 class="text-xl font-bold mb-6 relative">
                        <span class="relative z-10">Kontak Kami</span>
                        <div class="absolute -bottom-2 left-0 w-12 h-1 bg-kai-orange rounded-full"></div>
                    </h3>
                    <div class="space-y-4 text-gray-300">
                        <div class="flex items-center group hover:text-kai-orange transition-colors duration-300">
                            <div class="p-2 bg-kai-orange/20 rounded-full mr-3 group-hover:bg-kai-orange transition-colors duration-300">
                                <i class="fas fa-phone text-kai-orange group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <span class="font-medium">1500000</span>
                        </div>
                        <div class="flex items-center group hover:text-kai-orange transition-colors duration-300">
                            <div class="p-2 bg-kai-orange/20 rounded-full mr-3 group-hover:bg-kai-orange transition-colors duration-300">
                                <i class="fas fa-envelope text-kai-orange group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <span class="font-medium">info@kai.id</span>
                        </div>
                        <div class="flex items-start group hover:text-kai-orange transition-colors duration-300">
                            <div class="p-2 bg-kai-orange/20 rounded-full mr-3 mt-1 group-hover:bg-kai-orange transition-colors duration-300">
                                <i class="fas fa-map-marker-alt text-kai-orange group-hover:text-white transition-colors duration-300"></i>
                            </div>
                            <span class="font-medium">Jl. Perintis Kemerdekaan No. 1, Bandung 40117</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <div class="border-t border-white/20 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <p class="text-gray-300 mb-4 md:mb-0">
                        &copy; {{ date('Y') }} PT Kereta Api Indonesia (Persero). Semua hak dilindungi.
                    </p>
                    <div class="flex space-x-6 text-sm">
                        <a href="#" class="text-gray-300 hover:text-kai-orange transition-colors duration-300">Kebijakan Privasi</a>
                        <a href="#" class="text-gray-300 hover:text-kai-orange transition-colors duration-300">Syarat & Ketentuan</a>
                        <a href="#" class="text-gray-300 hover:text-kai-orange transition-colors duration-300">FAQ</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    
    <!-- Chatbot Component -->
    @include('components.chatbot')
    
    @yield('scripts')
</body>
</html>
