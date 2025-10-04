<!-- Cookie Consent Banner -->
<div x-data="cookieConsent()" 
     x-show="!accepted" 
     x-transition:enter="transition ease-out duration-500"
     x-transition:enter-start="transform translate-y-full opacity-0"
     x-transition:enter-end="transform translate-y-0 opacity-100"
     x-transition:leave="transition ease-in duration-300"
     x-transition:leave-start="transform translate-y-0 opacity-100"
     x-transition:leave-end="transform translate-y-full opacity-0"
     class="fixed bottom-0 left-0 right-0 z-50 bg-white/85 backdrop-blur-xl border-t-4 border-kai-blue shadow-2xl"
     style="display: none;">
    
    <div class="container mx-auto px-4 py-6">
        <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-6">
            
            <!-- Cookie Info Content -->
            <div class="flex-1 space-y-4">
                <div class="flex items-center">
                    <div class="bg-kai-blue/10 p-3 rounded-full mr-4 flex-shrink-0">
                        <i class="fas fa-cookie-bite text-kai-blue text-2xl"></i>
                    </div>
                    <div>
                        <h3 class="text-xl font-bold text-kai-blue mb-2">Penggunaan Cookies</h3>
                        <p class="text-gray-700 leading-relaxed">
                            Website KAI menggunakan cookies untuk meningkatkan pengalaman Anda dalam mengakses informasi jadwal dan layanan kami. 
                            Cookies membantu kami menyediakan fitur pencarian yang lebih baik dan menyimpan preferensi Anda.
                        </p>
                    </div>
                </div>
                
                <!-- Cookie Types -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 ml-16">
                    <div class="flex items-center p-3 bg-blue-50/60 backdrop-blur-md rounded-lg border border-blue-100/30">
                        <i class="fas fa-cog text-kai-blue mr-3"></i>
                        <div>
                            <div class="font-semibold text-sm text-kai-blue">Fungsional</div>
                            <div class="text-xs text-gray-600">Menyimpan preferensi</div>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-orange-50/60 backdrop-blur-md rounded-lg border border-orange-100/30">
                        <i class="fas fa-chart-bar text-kai-orange mr-3"></i>
                        <div>
                            <div class="font-semibold text-sm text-kai-orange">Analitik</div>
                            <div class="text-xs text-gray-600">Memahami penggunaan</div>
                        </div>
                    </div>
                    <div class="flex items-center p-3 bg-green-50/60 backdrop-blur-md rounded-lg border border-green-100/30">
                        <i class="fas fa-shield-alt text-green-600 mr-3"></i>
                        <div>
                            <div class="font-semibold text-sm text-green-600">Keamanan</div>
                            <div class="text-xs text-gray-600">Melindungi sesi</div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-3 lg:flex-col xl:flex-row flex-shrink-0">
                <button @click="acceptAll()" 
                        class="group relative px-6 py-3 bg-kai-blue text-white font-semibold rounded-xl hover:bg-kai-blue-light transition-all duration-300 transform hover:scale-105 hover:shadow-xl backdrop-blur-sm">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-check mr-2"></i>
                        Terima Semua
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-kai-blue to-kai-blue-light rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </button>
                
                <button @click="showSettings = !showSettings" 
                        class="px-6 py-3 border-2 border-kai-blue/60 text-kai-blue font-semibold rounded-xl bg-white/60 backdrop-blur-md hover:bg-kai-blue hover:text-white hover:border-kai-blue transition-all duration-300 hover:shadow-lg">
                    <i class="fas fa-cog mr-2"></i>
                    Pengaturan
                </button>
                
                <a href="{{ route('privacy') }}" 
                   class="px-6 py-3 text-gray-600 font-medium rounded-xl bg-gray-100/60 backdrop-blur-md hover:bg-gray-200/70 transition-all duration-300 text-center hover:shadow-md">
                    <i class="fas fa-info-circle mr-2"></i>
                    Pelajari Lebih
                </a>
            </div>
        </div>
        
        <!-- Cookie Settings Panel -->
        <div x-show="showSettings" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 transform -translate-y-4"
             x-transition:enter-end="opacity-100 transform translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 transform translate-y-0"
             x-transition:leave-end="opacity-0 transform -translate-y-4"
             class="mt-6 p-6 bg-gray-50/80 backdrop-blur-xl rounded-xl border border-gray-200/30 shadow-lg">
            
            <h4 class="text-lg font-bold text-kai-blue mb-4 flex items-center">
                <i class="fas fa-sliders-h mr-2"></i>
                Pengaturan Cookie
            </h4>
            
            <div class="space-y-4">
                <!-- Essential Cookies -->
                <div class="flex items-center justify-between p-4 bg-white/75 backdrop-blur-md rounded-lg border border-gray-100/30 shadow-sm">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-shield-check text-green-600 mr-2"></i>
                            <h5 class="font-semibold text-gray-800">Cookies Penting</h5>
                            <span class="ml-2 px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Wajib</span>
                        </div>
                        <p class="text-sm text-gray-600">Diperlukan untuk fungsi dasar website seperti navigasi dan keamanan.</p>
                    </div>
                    <div class="ml-4">
                        <div class="w-12 h-6 bg-green-500 rounded-full relative cursor-not-allowed opacity-75">
                            <div class="w-5 h-5 bg-white rounded-full absolute top-0.5 right-0.5 shadow-sm"></div>
                        </div>
                    </div>
                </div>
                
                <!-- Functional Cookies -->
                <div class="flex items-center justify-between p-4 bg-white/75 backdrop-blur-md rounded-lg border border-gray-100/30 shadow-sm">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-cog text-kai-blue mr-2"></i>
                            <h5 class="font-semibold text-gray-800">Cookies Fungsional</h5>
                        </div>
                        <p class="text-sm text-gray-600">Menyimpan preferensi pencarian dan pengaturan tampilan Anda.</p>
                    </div>
                    <div class="ml-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" x-model="settings.functional" class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kai-blue"></div>
                        </label>
                    </div>
                </div>
                
                <!-- Analytics Cookies -->
                <div class="flex items-center justify-between p-4 bg-white/75 backdrop-blur-md rounded-lg border border-gray-100/30 shadow-sm">
                    <div class="flex-1">
                        <div class="flex items-center mb-2">
                            <i class="fas fa-chart-line text-kai-orange mr-2"></i>
                            <h5 class="font-semibold text-gray-800">Cookies Analitik</h5>
                        </div>
                        <p class="text-sm text-gray-600">Membantu kami memahami bagaimana Anda menggunakan website untuk perbaikan layanan.</p>
                    </div>
                    <div class="ml-4">
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" x-model="settings.analytics" class="sr-only peer">
                            <div class="w-12 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-6 peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-0.5 after:bg-white after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-kai-orange"></div>
                        </label>
                    </div>
                </div>
            </div>
            
            <!-- Settings Actions -->
            <div class="flex flex-col sm:flex-row gap-3 mt-6">
                <button @click="acceptSelected()" 
                        class="flex-1 px-6 py-3 bg-kai-blue text-white font-semibold rounded-xl hover:bg-kai-blue-light transition-all duration-300 transform hover:scale-105 hover:shadow-lg backdrop-blur-sm">
                    <i class="fas fa-check mr-2"></i>
                    Simpan Pengaturan
                </button>
                <button @click="acceptAll()" 
                        class="flex-1 px-6 py-3 bg-kai-orange text-white font-semibold rounded-xl hover:bg-kai-orange-light transition-all duration-300 transform hover:scale-105 hover:shadow-lg backdrop-blur-sm">
                    <i class="fas fa-cookie mr-2"></i>
                    Terima Semua
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function cookieConsent() {
    return {
        accepted: false,
        showSettings: false,
        settings: {
            essential: true,
            functional: true,
            analytics: true
        },
        
        init() {
            // Check if user has already accepted cookies
            this.accepted = localStorage.getItem('kai_cookie_consent') === 'accepted';
            
            // Load saved settings
            const savedSettings = localStorage.getItem('kai_cookie_settings');
            if (savedSettings) {
                this.settings = { ...this.settings, ...JSON.parse(savedSettings) };
            }
            
            // Apply cookie settings
            this.applyCookieSettings();
        },
        
        acceptAll() {
            this.settings = {
                essential: true,
                functional: true,
                analytics: true
            };
            this.saveConsent();
        },
        
        acceptSelected() {
            this.saveConsent();
        },
        
        saveConsent() {
            localStorage.setItem('kai_cookie_consent', 'accepted');
            localStorage.setItem('kai_cookie_settings', JSON.stringify(this.settings));
            localStorage.setItem('kai_cookie_consent_date', new Date().toISOString());
            
            this.accepted = true;
            this.applyCookieSettings();
            
            // Show success notification
            this.showNotification('Pengaturan cookie berhasil disimpan!');
        },
        
        applyCookieSettings() {
            // Apply functional cookies
            if (this.settings.functional) {
                // Enable functional cookies (search preferences, UI settings, etc.)
                document.cookie = "kai_functional=enabled; path=/; max-age=" + (365 * 24 * 60 * 60);
            }
            
            // Apply analytics cookies
            if (this.settings.analytics) {
                // Enable analytics cookies (Google Analytics, etc.)
                document.cookie = "kai_analytics=enabled; path=/; max-age=" + (365 * 24 * 60 * 60);
                
                // Initialize analytics if available
                if (typeof gtag !== 'undefined') {
                    gtag('consent', 'update', {
                        'analytics_storage': 'granted'
                    });
                }
            } else {
                // Disable analytics
                if (typeof gtag !== 'undefined') {
                    gtag('consent', 'update', {
                        'analytics_storage': 'denied'
                    });
                }
            }
        },
        
        showNotification(message) {
            // Create temporary notification
            const notification = document.createElement('div');
            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform translate-x-full transition-transform duration-300';
            notification.innerHTML = `
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-2"></i>
                    <span>${message}</span>
                </div>
            `;
            
            document.body.appendChild(notification);
            
            // Animate in
            setTimeout(() => {
                notification.classList.remove('translate-x-full');
            }, 100);
            
            // Remove after 3 seconds
            setTimeout(() => {
                notification.classList.add('translate-x-full');
                setTimeout(() => {
                    document.body.removeChild(notification);
                }, 300);
            }, 3000);
        }
    }
}
</script>
