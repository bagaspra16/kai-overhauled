<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Panel Admin') - KAI Admin</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts - Inter (Same as main website) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    
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
    
    <!-- Custom Admin Styles -->
    <style>
        /* Custom Scrollbar */
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
        
        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_length select,
        .dataTables_wrapper .dataTables_filter input {
            @apply border border-gray-300 rounded-lg px-3 py-2 focus:border-kai-blue focus:ring-2 focus:ring-kai-blue/20 font-inter;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            @apply px-3 py-2 mx-1 rounded-lg border border-gray-300 text-gray-700 hover:bg-kai-blue hover:text-white hover:border-kai-blue transition-all duration-300 font-inter;
        }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            @apply bg-kai-blue text-white border-kai-blue;
        }
        
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_length label,
        .dataTables_wrapper .dataTables_filter label {
            @apply font-inter text-gray-700;
        }
        
        /* Form Controls */
        .form-control, .form-select {
            @apply border border-gray-300 rounded-lg px-4 py-3 focus:border-kai-blue focus:ring-2 focus:ring-kai-blue/20 transition-all duration-300 font-inter;
        }
        
        /* Buttons */
        .btn-primary {
            @apply bg-gradient-to-r from-kai-blue to-kai-blue-light text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-inter;
        }
        
        .btn-warning {
            @apply bg-gradient-to-r from-kai-orange to-kai-orange-light text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-inter;
        }
        
        .btn-success {
            @apply bg-gradient-to-r from-green-500 to-green-600 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-inter;
        }
        
        .btn-danger {
            @apply bg-gradient-to-r from-red-500 to-red-600 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-inter;
        }
        
        .btn-info {
            @apply bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-inter;
        }
        
        .btn-secondary {
            @apply bg-gradient-to-r from-gray-500 to-gray-600 text-white px-6 py-3 rounded-lg font-medium hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300 font-inter;
        }
        
        .btn-outline-primary {
            @apply border-2 border-kai-blue text-kai-blue px-6 py-3 rounded-lg font-medium hover:bg-kai-blue hover:text-white transition-all duration-300 font-inter;
        }
        
        .btn-outline-secondary {
            @apply border-2 border-gray-400 text-gray-600 px-6 py-3 rounded-lg font-medium hover:bg-gray-500 hover:text-white transition-all duration-300 font-inter;
        }
        
        .btn-outline-info {
            @apply border-2 border-blue-500 text-blue-500 px-6 py-3 rounded-lg font-medium hover:bg-blue-500 hover:text-white transition-all duration-300 font-inter;
        }
        
        .btn-outline-danger {
            @apply border-2 border-red-500 text-red-500 px-6 py-3 rounded-lg font-medium hover:bg-red-500 hover:text-white transition-all duration-300 font-inter;
        }
        
        /* Small buttons */
        .btn-sm {
            @apply px-3 py-2 text-sm;
        }
        
        /* Cards */
        .card {
            @apply bg-white rounded-xl shadow-lg border-0 hover:shadow-xl hover:-translate-y-1 transition-all duration-300;
        }
        
        .card-header {
            @apply bg-gradient-to-r from-kai-blue to-kai-blue-light text-white rounded-t-xl px-6 py-4 font-inter;
        }
        
        .card-body {
            @apply p-6 font-inter;
        }
        
        /* Tables */
        .table {
            @apply font-inter;
        }
        
        .table thead th {
            @apply bg-gradient-to-r from-kai-blue to-kai-blue-light text-white border-0 font-semibold font-inter;
        }
        
        .table tbody tr:hover {
            @apply bg-kai-blue/5;
        }
        
        /* Badges */
        .badge {
            @apply px-3 py-1 rounded-full text-sm font-medium font-inter;
        }
        
        /* Alerts */
        .alert {
            @apply rounded-lg border-0 font-inter;
        }
        
        /* Sidebar Animation */
        .sidebar-link {
            @apply transition-all duration-300 hover:translate-x-2;
        }
        
        /* Loading Animation */
        .loading-spinner {
            @apply animate-spin rounded-full h-8 w-8 border-b-2 border-kai-blue;
        }
        
        /* Stats Cards */
        .stats-card {
            @apply bg-gradient-to-br from-kai-blue to-kai-blue-light text-white rounded-xl p-6 shadow-lg hover:shadow-xl hover:-translate-y-1 transition-all duration-300 font-inter;
        }
        
        .stats-card.orange {
            @apply bg-gradient-to-br from-kai-orange to-kai-orange-light;
        }
        
        .stats-card.green {
            @apply bg-gradient-to-br from-green-500 to-green-600;
        }
        
        .stats-card.purple {
            @apply bg-gradient-to-br from-purple-500 to-purple-600;
        }
        
        .stats-card.indigo {
            @apply bg-gradient-to-br from-indigo-500 to-indigo-600;
        }
        
        /* Page Title */
        .page-title {
            @apply text-kai-blue font-bold text-3xl mb-6 font-inter;
        }
        
        /* Navigation Links */
        .nav-link {
            @apply font-inter;
        }
        
        /* Form Labels */
        .form-label {
            @apply font-inter font-medium text-gray-700;
        }
        
        /* Text */
        .text-muted {
            @apply text-gray-600 font-inter;
        }
        
        /* Mobile Responsive */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-50 font-inter antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar -->
        <nav class="w-64 bg-gradient-to-br from-kai-blue via-kai-blue-light to-kai-blue text-white shadow-2xl transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out fixed md:relative z-30 h-full" id="sidebar">
            <!-- Sidebar Brand -->
            <div class="p-6 border-b border-white/10">
                <div class="flex items-center justify-center">
                    <div class="relative group">
                        <div class="flex items-center space-x-3">
                            <img src="{{ asset('logo-background-2.png') }}" alt="KAI Logo" class="w-10 h-10 object-contain group-hover:scale-110 transition-transform duration-300">
                            <div>
                                <h2 class="text-xl font-bold">KAI Admin</h2>
                                <p class="text-xs text-white/70">Management Panel</p>
                            </div>
                        </div>
                        <div class="absolute -inset-1 bg-gradient-to-r from-kai-orange to-kai-orange-light rounded-lg blur opacity-0 group-hover:opacity-20 transition duration-300"></div>
                    </div>
                </div>
            </div>
            
            <!-- User Info -->
            <div class="p-4 mx-4 mt-4 bg-white/10 backdrop-blur-sm rounded-xl">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 bg-kai-orange rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <p class="text-sm text-white/70">Welcome back,</p>
                        <p class="font-semibold">{{ Auth::user()->name }}</p>
                    </div>
                </div>
            </div>

            <!-- Navigation Menu -->
            <div class="mt-6 px-4">
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.dashboard*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-tachometer-alt w-5 mr-3"></i>
                            <span class="font-medium">Dasbor</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.about.index') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.about*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-info-circle w-5 mr-3"></i>
                            <span class="font-medium">Tentang</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.news.index') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.news*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-newspaper w-5 mr-3"></i>
                            <span class="font-medium">Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profiles.index') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.profiles*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-users w-5 mr-3"></i>
                            <span class="font-medium">Profil</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.services.index') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.services*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-cogs w-5 mr-3"></i>
                            <span class="font-medium">Layanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.stations.index') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.stations*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-map-marker-alt w-5 mr-3"></i>
                            <span class="font-medium">Stasiun</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.routes.index') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.routes*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-route w-5 mr-3"></i>
                            <span class="font-medium">Rute</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.schedules.index') }}" 
                           class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-white/10 transition-all duration-300 {{ request()->routeIs('admin.schedules*') ? 'bg-white/10 text-white' : '' }}">
                            <i class="fas fa-calendar-alt w-5 mr-3"></i>
                            <span class="font-medium">Jadwal</span>
                        </a>
                    </li>
                </ul>
                
                <!-- Logout -->
                <div class="mt-8 pt-6 border-t border-white/10">
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="sidebar-link flex items-center px-4 py-3 rounded-lg text-white/80 hover:text-white hover:bg-red-500/20 transition-all duration-300 w-full">
                            <i class="fas fa-sign-out-alt w-5 mr-3"></i>
                            <span class="font-medium">Keluar</span>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden md:ml-0">
            <!-- Top Header -->
            <header class="bg-white shadow-lg border-b border-gray-200">
                <div class="flex items-center justify-between px-6 py-4">
                    <!-- Mobile menu button -->
                    <button class="md:hidden text-kai-blue hover:text-kai-orange transition-colors duration-300" onclick="toggleSidebar()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                    
                    <!-- Page Title Area -->
                    <div class="flex-1 md:ml-0">
                        <!-- This will be filled by individual pages -->
                    </div>
                    
                    <!-- Header Actions -->
                    <div class="flex items-center space-x-4">
                        <!-- Visit Website -->
                        <a href="{{ route('home') }}" 
                           target="_blank"
                           class="flex items-center px-4 py-2 bg-gradient-to-r from-kai-orange to-kai-orange-light text-white rounded-lg hover:shadow-lg hover:-translate-y-0.5 transition-all duration-300">
                            <i class="fas fa-external-link-alt mr-2"></i>
                            <span class="hidden sm:inline">Kunjungi Website</span>
                        </a>
                        
                        <!-- User Profile -->
                        <div class="flex items-center space-x-2 text-gray-700">
                            <div class="w-8 h-8 bg-kai-blue rounded-full flex items-center justify-center">
                                <i class="fas fa-user text-white text-sm"></i>
                            </div>
                            <span class="hidden sm:inline font-medium">{{ Auth::user()->name }}</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-y-auto bg-gray-50">
                <div class="p-6">
                    <!-- Alerts -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg flex items-center animate-fade-in">
                            <i class="fas fa-check-circle mr-3 text-green-500"></i>
                            <span class="font-medium">{{ session('success') }}</span>
                            <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg flex items-center animate-fade-in">
                            <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                            <span class="font-medium">{{ session('error') }}</span>
                            <button type="button" class="ml-auto text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg animate-fade-in">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-exclamation-triangle mr-3 text-red-500"></i>
                                <span class="font-medium">Please fix the following errors:</span>
                                <button type="button" class="ml-auto text-red-500 hover:text-red-700" onclick="this.parentElement.parentElement.remove()">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                            <ul class="list-disc list-inside space-y-1 ml-6">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Page Content -->
                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <!-- Overlay for mobile sidebar -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden hidden" id="sidebar-overlay" onclick="toggleSidebar()"></div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Initialize DataTables
        $(document).ready(function() {
            $('.data-table').DataTable({
                responsive: true,
                pageLength: 10,
                order: [[0, 'desc']],
                language: {
                    search: "Search:",
                    lengthMenu: "Show _MENU_ entries",
                    info: "Showing _START_ to _END_ of _TOTAL_ entries",
                    paginate: {
                        first: "First",
                        last: "Last",
                        next: "Next",
                        previous: "Previous"
                    }
                }
            });
        });

        // Mobile sidebar toggle
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebar-overlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
        }

        // Confirm delete
        function confirmDelete(url, title = 'Are you sure?') {
            Swal.fire({
                title: title,
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#ef4444',
                cancelButtonColor: '#6b7280',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
                customClass: {
                    popup: 'font-inter',
                    title: 'font-inter font-bold',
                    content: 'font-inter',
                    confirmButton: 'font-inter font-medium',
                    cancelButton: 'font-inter font-medium'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Create form and submit
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = url;
                    
                    const csrfToken = document.createElement('input');
                    csrfToken.type = 'hidden';
                    csrfToken.name = '_token';
                    csrfToken.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    
                    const methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    
                    form.appendChild(csrfToken);
                    form.appendChild(methodField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.animate-fade-in');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-10px)';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const sidebarToggle = event.target.closest('[onclick="toggleSidebar()"]');
            
            if (window.innerWidth < 768 && !sidebar.contains(event.target) && !sidebarToggle) {
                if (!sidebar.classList.contains('-translate-x-full')) {
                    toggleSidebar();
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
