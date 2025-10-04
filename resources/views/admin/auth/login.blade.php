<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Masuk Admin - KAI Admin Panel</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Inter (Same as main website) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- Custom Tailwind Config (Same as main website) -->
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
    
    <style>
        body {
            background: linear-gradient(135deg, #2c2a6b 0%, #3d3b7a 50%, #eb6a28 100%);
            min-height: 100vh;
            font-family: 'Inter', sans-serif;
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: transparent;
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(44, 42, 107, 0.3);
            border-radius: 4px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: rgba(44, 42, 107, 0.5);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-kai-blue via-kai-blue-light to-kai-orange min-h-screen font-inter antialiased overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Ccircle cx="30" cy="30" r="2"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <!-- Floating Shapes -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-1/4 left-1/4 w-20 h-20 bg-white/10 rounded-full animate-float"></div>
        <div class="absolute top-3/4 right-1/4 w-16 h-16 bg-kai-orange/20 rounded-full animate-float" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-1/4 left-1/3 w-24 h-24 bg-white/5 rounded-full animate-float" style="animation-delay: 4s;"></div>
    </div>

    <!-- Main Container -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-4xl">
            <!-- Login Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden backdrop-blur-sm bg-white/95 animate-scale-in">
                <div class="grid md:grid-cols-2">
                    <!-- Left Side - Branding -->
                    <div class="bg-gradient-to-br from-kai-blue to-kai-blue-light text-white p-12 flex flex-col justify-center items-center text-center relative overflow-hidden">
                        <!-- Background Pattern -->
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute top-0 left-0 w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width="40" height="40" viewBox="0 0 40 40" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M20 20c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10zm10 0c0-5.5-4.5-10-10-10s-10 4.5-10 10 4.5 10 10 10 10-4.5 10-10z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
                        </div>
                        
                        <div class="relative z-10">
                            <!-- Logo -->
                            <div class="mb-8 group">
                                <div class="relative">
                                    <div class="flex items-center justify-center mb-4">
                                        <img src="{{ asset('logo-background-2.png') }}" alt="KAI Logo" class="w-16 h-16 object-contain group-hover:scale-110 transition-transform duration-300">
                                    </div>
                                    <div class="absolute -inset-2 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-full blur opacity-0 group-hover:opacity-30 transition duration-300"></div>
                                </div>
                            </div>
                            
                            <!-- Title -->
                            <h1 class="text-4xl font-bold mb-4 animate-slide-down">Panel Admin KAI</h1>
                            <p class="text-xl text-white/90 mb-8 animate-slide-up">Sistem Manajemen Konten</p>
                            
                            <!-- Security Info -->
                            <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 animate-fade-in" style="animation-delay: 0.5s;">
                                <div class="text-kai-orange mb-3">
                                    <i class="fas fa-shield-alt text-3xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold mb-2">Login Aman</h3>
                                <p class="text-sm text-white/80">Dilindungi dengan langkah keamanan canggih dan pemantauan</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Right Side - Login Form -->
                    <div class="p-12">
                        <div class="max-w-md mx-auto">
                            <!-- Form Title -->
                            <div class="text-center mb-8">
                                <h2 class="text-3xl font-bold text-kai-blue mb-2">Selamat Datang Kembali</h2>
                                <p class="text-gray-600">Silakan masuk ke akun admin Anda</p>
                            </div>
                            
                            <!-- Alerts -->
                            @if(session('success'))
                                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center animate-fade-in">
                                    <i class="fas fa-check-circle mr-3 text-green-500"></i>
                                    <span>{{ session('success') }}</span>
                                </div>
                            @endif

                            @if(session('error'))
                                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center animate-fade-in">
                                    <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                                    <span>{{ session('error') }}</span>
                                </div>
                            @endif

                            @if($errors->any())
                                <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg animate-fade-in">
                                    <div class="flex items-center mb-2">
                                        <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                                        <span class="font-medium">Harap perbaiki kesalahan berikut:</span>
                                    </div>
                                    <ul class="list-disc list-inside ml-6 space-y-1">
                                        @foreach($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-6">
                                @csrf
                                
                                <!-- Username Field -->
                                <div class="space-y-2">
                                    <label for="username" class="block text-sm font-medium text-gray-700">
                                        <i class="fas fa-user mr-2 text-kai-blue"></i>Nama Pengguna
                                    </label>
                                    <input type="text" 
                                           id="username" 
                                           name="username" 
                                           value="{{ old('username') }}"
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('username') border-red-500 @enderror"
                                           placeholder="Masukkan nama pengguna"
                                           required 
                                           autdariocus>
                                </div>

                                <!-- Kata Sandi Field -->
                                <div class="space-y-2">
                                    <label for="password" class="block text-sm font-medium text-gray-700">
                                        <i class="fas fa-lock mr-2 text-kai-blue"></i>Kata Sandi
                                    </label>
                                    <input type="password" 
                                           id="password" 
                                           name="password" 
                                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-kai-blue focus:border-kai-blue transition-all duration-300 @error('password') border-red-500 @enderror"
                                           placeholder="Masukkan kata sandi Anda"
                                           required>
                                </div>

                                <!-- Ingat Saya -->
                                <div class="flex items-center">
                                    <input type="checkbox" 
                                           id="remember" 
                                           name="remember" 
                                           class="h-4 w-4 text-kai-blue focus:ring-kai-blue border-gray-300 rounded">
                                    <label for="remember" class="ml-2 block text-sm text-gray-700">
                                        Ingat saya selama 30 hari
                                    </label>
                                </div>

                                <!-- Login Button -->
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-kai-blue to-kai-blue-light text-white py-3 px-6 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-kai-blue focus:ring-darifset-2"
                                        id="login-btn">
                                    <i class="fas fa-sign-in-alt mr-2"></i>
                                    Masuk ke Panel Admin
                                </button>
                            </form>

                            <!-- Security Notice -->
                            <div class="mt-8 text-center">
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="flex items-center justify-center text-gray-600 text-sm">
                                        <i class="fas fa-info-circle mr-2 text-kai-blue"></i>
                                        <span>Semua percobaan login dipantau dan dicatat untuk tujuan keamanan</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Back to Website -->
                            <div class="mt-6 text-center">
                                <a href="{{ route('home') }}" 
                                   class="inline-flex items-center text-kai-blue hover:text-kai-orange transition-colors duration-300">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    <span>Kembali ke Website Utama</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Auto-hide alerts after 5 detik
        setTimeout(function() {
            document.querySelectorAll('.animate-fade-in').forEach(function(alert) {
                if (alert.classList.contains('bg-green-50') || alert.classList.contains('bg-red-50')) {
                    alert.style.transition = 'opacity 0.5s, transform 0.5s';
                    alert.style.opacity = '0';
                    alert.style.transform = 'translateY(-10px)';
                    setTimeout(function() {
                        alert.remove();
                    }, 500);
                }
            });
        }, 5000);

        // Add loading state to form submission
        document.querySelector('form').addEventListener('submit', function() {
            const button = document.getElementById('login-btn');
            button.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Sedang masuk...';
            button.disabled = true;
            button.classList.add('opacity-75', 'cursor-not-allowed');
        });

        // Add focus effects to form inputs
        document.querySelectorAll('input').forEach(function(input) {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('transform', 'scale-105');
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('transform', 'scale-105');
            });
        });
    </script>
</body>
</html>
