@extends('layouts.app')

@section('title', 'Kontak - PT Kereta Api Indonesia')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Slideshow -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat transition-opacity duration-1000" 
         style="background-image: url('https://images.unsplash.com/photo-1521737711867-e3b97375f902?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');">
        <div class="absolute inset-0 bg-gradient-to-br from-kai-blue/80 via-kai-blue/70 to-kai-blue/90"></div>
    </div>
    
    
    <div class="relative z-10 container mx-auto px-4 text-center text-kai-white">
        <div class="max-w-4xl mx-auto">
            <div class="inline-block mb-6">
                <span class="text-kai-orange font-semibold text-lg uppercase tracking-wider bg-white/10 backdrop-blur-sm px-6 py-2 rounded-full">
                    Kontak
                </span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6 animate-fade-in">
                Hubungi Kami
            </h1>
            <p class="text-xl md:text-2xl text-gray-200 max-w-4xl mx-auto leading-relaxed animate-slide-up">
            Kami siap membantu Anda dengan segala informasi dan layanan yang Anda butuhkan
            </p>
            
            <!-- Scroll Indicator -->
            <div class="mt-12 animate-bounce">
                <div class="flex flex-col items-center text-kai-white cursor-pointer" @click="window.scrollTo({ top: window.innerHeight, behavior: 'smooth' })">
                    <span class="text-sm mb-2">Geser ke bawah</span>
                    <i class="fas fa-chevron-down text-2xl"></i>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-3xl font-bold text-kai-blue mb-6">Kirim Pesan</h2>
                <form x-data="{ formData: { name: '', email: '', subject: '', message: '' }, submitting: false, submitted: false }" 
                      @submit.prevent="submitting = true; setTimeout(() => { submitted = true; submitting = false }, 2000)">
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                            <input type="text" id="name" x-model="formData.name" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-kai-orange focus:border-transparent">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                            <input type="email" id="email" x-model="formData.email" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-kai-orange focus:border-transparent">
                        </div>
                    </div>
                    
                    <div class="mb-6">
                        <label for="subject" class="block text-sm font-medium text-gray-700 mb-2">Subjek</label>
                        <select id="subject" x-model="formData.subject" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-kai-orange focus:border-transparent">
                            <option value="">Pilih subjek</option>
                            <option value="layanan">Informasi Layanan</option>
                            <option value="jadwal">Jadwal & Tiket</option>
                            <option value="keluhan">Keluhan</option>
                            <option value="saran">Saran & Kritik</option>
                            <option value="kerjasama">Kerjasama</option>
                            <option value="lainnya">Lainnya</option>
                        </select>
                    </div>
                    
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium text-gray-700 mb-2">Pesan</label>
                        <textarea id="message" x-model="formData.message" rows="5" required
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-kai-orange focus:border-transparent"
                                  placeholder="Tuliskan pesan Anda di sini..."></textarea>
                    </div>
                    
                    <div x-show="!submitted">
                        <button type="submit" :disabled="submitting"
                                :class="submitting ? 'bg-gray-400 cursor-not-allowed' : 'bg-kai-orange hover:bg-orange-600'"
                                class="w-full text-white px-8 py-3 rounded-lg font-semibold transition-colors duration-300">
                            <span x-show="!submitting">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pesan
                            </span>
                            <span x-show="submitting">
                                <i class="fas fa-spinner fa-spin mr-2"></i>
                                Mengirim...
                            </span>
                        </button>
                    </div>
                    
                    <div x-show="submitted" x-transition class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle mr-2"></i>
                            <span>Terima kasih! Pesan Anda telah berhasil dikirim.</span>
                        </div>
                    </div>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div class="space-y-8">
                @if($profile)
                <!-- Company Information -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-kai-blue mb-6">
                        <i class="fas fa-building mr-2"></i>
                        Informasi Perusahaan
                    </h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <i class="fas fa-map-marker-alt text-kai-orange text-xl mr-4 mt-1"></i>
                            <div>
                                <div class="font-semibold text-gray-800">Alamat</div>
                                <div class="text-gray-600">{{ $profile->alamat }}</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope text-kai-orange text-xl mr-4"></i>
                            <div>
                                <div class="font-semibold text-gray-800">Email</div>
                                <div class="text-gray-600">{{ $profile->email }}</div>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone text-kai-orange text-xl mr-4"></i>
                            <div>
                                <div class="font-semibold text-gray-800">Telepon</div>
                                <div class="text-gray-600">{{ $profile->telepon }}</div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <!-- Quick Contact -->
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h3 class="text-2xl font-bold text-kai-blue mb-6">
                        <i class="fas fa-headset mr-2"></i>
                        Kontak Cepat
                    </h3>
                    <div class="space-y-6">
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                            <div class="bg-kai-blue text-white rounded-full w-12 h-12 flex items-center justify-center mr-4">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">Customer Service</div>
                                <div class="text-gray-600">24 Jam Non-Stop</div>
                                <a href="tel:1500000" class="text-kai-orange font-semibold hover:text-orange-600 transition-colors duration-300">
                                    1500000
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                            <div class="bg-green-500 text-white rounded-full w-12 h-12 flex items-center justify-center mr-4">
                                <i class="fab fa-whatsapp"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">WhatsApp</div>
                                <div class="text-gray-600">Chat Langsung</div>
                                <a href="https://wa.me/628111500000" class="text-kai-orange font-semibold hover:text-orange-600 transition-colors duration-300">
                                    +62 811-1500-000
                                </a>
                            </div>
                        </div>
                        
                        <div class="flex items-center p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                            <div class="bg-blue-500 text-white rounded-full w-12 h-12 flex items-center justify-center mr-4">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">Email</div>
                                <div class="text-gray-600">Responsif & Cepat</div>
                                <a href="mailto:info@kai.id" class="text-kai-orange font-semibold hover:text-orange-600 transition-colors duration-300">
                                    info@kai.id
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Office Hours Section -->
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-kai-blue mb-4">Jam Layanan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kami siap melayani Anda dengan jam operasional yang fleksibel
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-kai-blue text-white">
                            <tr>
                                <th class="px-6 py-4 text-left">Layanan</th>
                                <th class="px-6 py-4 text-left">Jam Operasional</th>
                                <th class="px-6 py-4 text-left">Keterangan</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">Customer Service</td>
                                <td class="px-6 py-4">24 Jam</td>
                                <td class="px-6 py-4 text-gray-600">Non-stop setiap hari</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">Pemesanan Tiket Online</td>
                                <td class="px-6 py-4">24 Jam</td>
                                <td class="px-6 py-4 text-gray-600">Melalui website dan aplikasi</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">Layanan Kereta</td>
                                <td class="px-6 py-4">05:00 - 24:00</td>
                                <td class="px-6 py-4 text-gray-600">Sesuai jadwal keberangkatan</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">Informasi Jadwal</td>
                                <td class="px-6 py-4">24 Jam</td>
                                <td class="px-6 py-4 text-gray-600">Online dan offline</td>
                            </tr>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 font-medium">Layanan Kargo</td>
                                <td class="px-6 py-4">08:00 - 17:00</td>
                                <td class="px-6 py-4 text-gray-600">Senin - Jumat</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold text-kai-blue mb-4">Pertanyaan yang Sering Diajukan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Temukan jawaban untuk pertanyaan umum tentang layanan KAI
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto" x-data="{ openFaq: null }">
            <div class="space-y-4">
                <!-- FAQ Item 1 -->
                <div class="bg-white rounded-lg shadow-lg">
                    <button @click="openFaq = openFaq === 1 ? null : 1" 
                            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-300">
                        <span class="font-semibold text-kai-blue">Bagaimana cara memesan tiket kereta api?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300" :class="openFaq === 1 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openFaq === 1" x-transition class="px-6 pb-4 text-gray-600">
                        Anda dapat memesan tiket melalui website resmi KAI, aplikasi mobile, atau langsung di stasiun. Pemesanan online tersedia 24 jam.
                    </div>
                </div>
                
                <!-- FAQ Item 2 -->
                <div class="bg-white rounded-lg shadow-lg">
                    <button @click="openFaq = openFaq === 2 ? null : 2" 
                            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-300">
                        <span class="font-semibold text-kai-blue">Apakah ada layanan antar jemput dari stasiun?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300" :class="openFaq === 2 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openFaq === 2" x-transition class="px-6 pb-4 text-gray-600">
                        Ya, beberapa stasiun menyediakan layanan antar jemput dengan biaya tambahan. Silakan hubungi customer service untuk informasi lebih detail.
                    </div>
                </div>
                
                <!-- FAQ Item 3 -->
                <div class="bg-white rounded-lg shadow-lg">
                    <button @click="openFaq = openFaq === 3 ? null : 3" 
                            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-300">
                        <span class="font-semibold text-kai-blue">Bagaimana jika kereta terlambat?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300" :class="openFaq === 3 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openFaq === 3" x-transition class="px-6 pb-4 text-gray-600">
                        Jika terjadi keterlambatan, penumpang akan mendapat informasi melalui pengumuman di stasiun dan dapat melakukan refund sesuai ketentuan yang berlaku.
                    </div>
                </div>
                
                <!-- FAQ Item 4 -->
                <div class="bg-white rounded-lg shadow-lg">
                    <button @click="openFaq = openFaq === 4 ? null : 4" 
                            class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 transition-colors duration-300">
                        <span class="font-semibold text-kai-blue">Apakah ada fasilitas untuk penyandang disabilitas?</span>
                        <i class="fas fa-chevron-down transition-transform duration-300" :class="openFaq === 4 ? 'rotate-180' : ''"></i>
                    </button>
                    <div x-show="openFaq === 4" x-transition class="px-6 pb-4 text-gray-600">
                        Ya, KAI menyediakan fasilitas khusus untuk penyandang disabilitas termasuk akses ramah kursi roda dan bantuan staf yang terlatih.
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Social Media Section -->
<section class="py-16 mb-20 bg-gradient-to-r from-kai-blue to-blue-800">
    <div class="container mx-auto px-4 text-center text-kai-white">
        <h2 class="text-4xl font-bold mb-6">Ikuti Kami di Media Sosial</h2>
        <p class="text-xl text-gray-200 mb-8 max-w-2xl mx-auto">
            Dapatkan informasi terbaru dan update dari PT Kereta Api Indonesia
        </p>
        
        <div class="flex justify-center space-x-6">
            <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-4 rounded-full transition-all duration-300 transform hover:scale-110">
                <i class="fab fa-facebook-f text-2xl"></i>
            </a>
            <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-4 rounded-full transition-all duration-300 transform hover:scale-110">
                <i class="fab fa-twitter text-2xl"></i>
            </a>
            <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-4 rounded-full transition-all duration-300 transform hover:scale-110">
                <i class="fab fa-instagram text-2xl"></i>
            </a>
            <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-4 rounded-full transition-all duration-300 transform hover:scale-110">
                <i class="fab fa-youtube text-2xl"></i>
            </a>
            <a href="#" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-4 rounded-full transition-all duration-300 transform hover:scale-110">
                <i class="fab fa-tiktok text-2xl"></i>
            </a>
        </div>
    </div>
</section>
@endsection

