<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\ChatHistory;
use App\Models\KaiNews;
use App\Models\KaiService;
use App\Models\KaiAbout;
use App\Models\KaiProfile;
use App\Models\Station;
use App\Models\Route;
use App\Models\Schedule;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ChatbotController extends Controller
{
    /**
     * KAI-related keywords and responses
     */
    private $kaiKeywords = [
        'kereta', 'kai', 'tiket', 'jadwal', 'stasiun', 'perjalanan', 'transportasi',
        'booking', 'reservasi', 'harga', 'tarif', 'rute', 'tujuan', 'berangkat',
        'datang', 'eksekutif', 'bisnis', 'ekonomi', 'argo', 'gajayana', 'bima',
        'taksaka', 'sancaka', 'turangga', 'lodaya', 'parahyangan', 'ciremai',
        'bengawan', 'mutiara', 'jayabaya', 'malabar', 'serayu', 'progo',
        'jakarta', 'bandung', 'surabaya', 'yogyakarta', 'semarang', 'solo',
        'malang', 'cirebon', 'purwokerto', 'madiun', 'kediri', 'blitar',
        'gambir', 'pasar senen', 'jatinegara', 'cikini', 'manggarai', 'bogor',
        'depok', 'bekasi', 'karawang', 'purwakarta', 'cicalengka', 'padalarang',
        'berita', 'news', 'informasi', 'layanan', 'service', 'tentang', 'about',
        'profile', 'profil', 'visi', 'misi', 'sejarah', 'alamat', 'telepon',
        'email', 'website', 'schedule', 'route', 'station', 'train', 'railway',
        'dari', 'ke', 'menuju', 'tiba', 'sampai', 'durasi', 'waktu', 'jam',
        'menit', 'ongkos', 'biaya', 'bayar', 'pembayaran', 'pesan', 'beli'
    ];

    private $kaiResponses = [
        'jadwal' => [
            'Untuk informasi jadwal kereta api, Anda dapat mengecek melalui aplikasi KAI Access atau website resmi KAI. Jadwal kereta dapat berubah sewaktu-waktu.',
            'Jadwal kereta api tersedia di aplikasi KAI Access. Anda juga bisa menanyakan jadwal spesifik dengan menyebutkan rute perjalanan.',
            'Silakan gunakan fitur pencarian tiket di website ini atau aplikasi KAI Access untuk melihat jadwal kereta terkini.'
        ],
        'tiket' => [
            'Pembelian tiket kereta api dapat dilakukan melalui aplikasi KAI Access, website resmi, atau loket stasiun terdekat.',
            'Tiket kereta dapat dibeli H-90 sebelum keberangkatan. Pastikan membawa identitas asli saat perjalanan.',
            'Untuk pembelian tiket, silakan gunakan KAI Access atau kunjungi loket stasiun. Jangan lupa bawa KTP/identitas resmi.'
        ],
        'harga' => [
            'Harga tiket kereta bervariasi tergantung kelas, rute, dan waktu perjalanan. Cek harga terkini di KAI Access.',
            'Tarif kereta api berbeda untuk setiap kelas (Ekonomi, Bisnis, Eksekutif). Silakan cek di aplikasi untuk harga terupdate.',
            'Harga tiket dapat berubah tergantung demand dan waktu. Gunakan KAI Access untuk melihat harga real-time.'
        ],
        'stasiun' => [
            'KAI melayani ratusan stasiun di seluruh Indonesia. Stasiun mana yang ingin Anda ketahui informasinya?',
            'Informasi stasiun lengkap tersedia di website dan aplikasi KAI. Ada stasiun tertentu yang ingin ditanyakan?',
            'Setiap stasiun KAI memiliki fasilitas yang berbeda. Sebutkan nama stasiun untuk informasi lebih detail.'
        ],
        'default' => [
            'Terima kasih telah menghubungi layanan chatbot KAI. Ada yang bisa saya bantu terkait layanan kereta api?',
            'Halo! Saya siap membantu Anda dengan informasi seputar layanan KAI. Silakan tanyakan apa saja.',
            'Selamat datang di layanan chatbot KAI. Saya dapat membantu dengan informasi jadwal, tiket, dan layanan lainnya.'
        ]
    ];

    /**
     * Process chat message
     */
    public function chat(Request $request): JsonResponse
    {
        try {
            $request->validate([
                'message' => 'required|string|max:1000',
                'session_id' => 'nullable|string'
            ]);

            $message = $request->input('message');
            $sessionId = $request->input('session_id', session()->getId());

            // Save user message to history
            $this->saveChatHistory($sessionId, 'user', $message);

            // Process the message
            $response = $this->processMessage($message);

            // Save bot response to history
            $this->saveChatHistory($sessionId, 'bot', $response);

            return response()->json([
                'success' => true,
                'response' => $response,
                'session_id' => $sessionId,
                'timestamp' => now()->toISOString()
            ]);

        } catch (\Exception $e) {
            Log::error('Chatbot error: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'response' => 'Maaf, terjadi kesalahan. Silakan coba lagi dalam beberapa saat.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Process message and determine response type
     */
    private function processMessage(string $message): string
    {
        // Check for Commuter Line queries first
        $commuterResponse = $this->handleCommuterLineQuery($message);
        if ($commuterResponse) {
            return $commuterResponse;
        }
        
        // Check if it's a general query that should go to external API
        if ($this->isGeneralOrSimpleQuery($message)) {
            $externalResponse = $this->handleExternalQuery($message);
            
            // If external API gives a generic response, try KAI database
            if ($this->isGenericKaiResponse($externalResponse)) {
                return $this->generateKaiResponseFromDatabase($message);
            }
            
            return $externalResponse;
        }
        
        // For KAI-specific queries, use database first
        return $this->generateKaiResponseFromDatabase($message);
    }

    /**
     * Handle Commuter Line specific queries
     */
    private function handleCommuterLineQuery(string $message): ?string
    {
        $originalMessage = $message;
        $message = strtolower($message);
        
        // Define commuter line keywords and variations
        $commuterKeywords = [
            'commuter', 'commuterline', 'commuter line', 'krl', 'kereta rel listrik',
            'kereta listrik', 'kereta komuter', 'komuter', 'lokal', 'urban',
            'jadwal krl', 'rute krl', 'stasiun krl', 'tarif krl', 'tiket krl',
            'kereta kota', 'kereta dalam kota', 'transportasi krl', 'angkutan krl'
        ];
        
        // Check if message contains commuter line keywords
        $isCommuterQuery = false;
        foreach ($commuterKeywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                $isCommuterQuery = true;
                break;
            }
        }
        
        if (!$isCommuterQuery) {
            return null;
        }
        
        // Define city mappings with variations
        $cityMappings = [
            'jabodetabek' => [
                'keywords' => ['jabodetabek', 'jakarta', 'bogor', 'depok', 'tangerang', 'bekasi', 'jabotabek', 'jkt', 'jabo'],
                'pdf' => '/assets/Comuter-KAI-Line-Jabodetabek.pdf',
                'city_name' => 'Jabodetabek'
            ],
            'bandung' => [
                'keywords' => ['bandung', 'bdg', 'kota kembang', 'paris van java'],
                'pdf' => '/assets/Comuter-KAI-Line-Bandung.pdf',
                'city_name' => 'Bandung'
            ],
            'surabaya' => [
                'keywords' => ['surabaya', 'sby', 'kota pahlawan', 'arek suroboyo'],
                'pdf' => '/assets/Comuter-KAI-Line-Surabaya.pdf',
                'city_name' => 'Surabaya'
            ],
            'yogyakarta' => [
                'keywords' => ['yogyakarta', 'yogya', 'jogja', 'jogjakarta', 'yk', 'diy', 'istimewa'],
                'pdf' => '/assets/Comuter-KAI-Line-Yogyakarta.pdf',
                'city_name' => 'Yogyakarta'
            ]
        ];
        
        // Find matching city
        $matchedCity = null;
        foreach ($cityMappings as $cityKey => $cityData) {
            foreach ($cityData['keywords'] as $cityKeyword) {
                if (strpos($message, $cityKeyword) !== false) {
                    $matchedCity = $cityData;
                    break 2;
                }
            }
        }
        
        // Generate response based on matched city
        if ($matchedCity) {
            return $this->generateCommuterLineResponse($matchedCity, $originalMessage);
        }
        
        // If no specific city found, provide general commuter line info
        return $this->generateGeneralCommuterLineResponse($originalMessage);
    }
    
    /**
     * Generate specific commuter line response for a city
     */
    private function generateCommuterLineResponse(array $cityData, string $originalMessage): string
    {
        $cityName = $cityData['city_name'];
        
        // Generate secure view link
        $cityKey = strtolower($cityName);
        if ($cityKey === 'jabodetabek') {
            $viewUrl = route('view.panduan', 'jabodetabek');
        } elseif ($cityKey === 'bandung') {
            $viewUrl = route('view.panduan', 'bandung');
        } elseif ($cityKey === 'surabaya') {
            $viewUrl = route('view.panduan', 'surabaya');
        } elseif ($cityKey === 'yogyakarta') {
            $viewUrl = route('view.panduan', 'yogyakarta');
        } else {
            $viewUrl = '#';
        }
        
        // Generate dynamic AI-like responses with hidden URLs
        $responses = [
            "🚆 **Informasi KRL Commuter Line {$cityName}**\n\nSaya memiliki informasi lengkap tentang jadwal dan rute KRL Commuter Line {$cityName}. Berikut adalah panduan resmi yang bisa membantu Anda:\n\n📋 [Link]({$viewUrl})\n\nPanduan ini mencakup:\n✅ Jadwal keberangkatan lengkap\n✅ Peta rute dan stasiun\n✅ Tarif dan informasi tiket\n✅ Tips perjalanan\n\nAda yang ingin ditanyakan lebih lanjut tentang KRL {$cityName}?",
            
            "🚄 **KRL Commuter Line {$cityName} - Panduan Lengkap**\n\nUntuk informasi terkini tentang KRL Commuter Line {$cityName}, saya telah menyiapkan panduan resmi yang sangat detail:\n\n📖 [Link]({$viewUrl})\n\nDalam panduan ini Anda akan menemukan:\n🕐 Jadwal operasional terbaru\n🗺️ Peta jalur dan stasiun\n💰 Informasi tarif\n📱 Cara pembelian tiket\n\nSilakan klik link untuk melihat panduan lengkap!",
            
            "🚊 **Panduan KRL {$cityName} - Siap Membantu Perjalanan Anda**\n\nSaya punya informasi komprehensif tentang KRL Commuter Line {$cityName} yang pasti berguna untuk Anda:\n\n📄 [Link]({$viewUrl})\n\nPanduan ini berisi:\n⏰ Jadwal kereta terlengkap\n🚉 Daftar stasiun dan rute\n🎫 Info tiket dan pembayaran\n🔔 Update layanan terbaru\n\nApakah ada rute atau jadwal spesifik yang ingin Anda ketahui?",
            
            "🎯 **Perfect! Informasi KRL {$cityName} yang Anda cari**\n\nSaya mengerti Anda membutuhkan informasi tentang KRL Commuter Line {$cityName}. Saya punya solusi yang tepat:\n\n📚 [Link]({$viewUrl})\n\n🔍 **Yang akan Anda dapatkan:**\n• Jadwal real-time terkini\n• Peta interaktif rute & stasiun\n• Panduan tarif & cara bayar\n• Info layanan khusus\n\nSemua informasi sudah terupdate dan resmi dari KAI. Butuh info spesifik lainnya?",
            
            "💡 **KRL {$cityName} - Semua yang Perlu Anda Tahu**\n\nBerdasarkan pertanyaan Anda, saya rekomendasikan panduan lengkap ini:\n\n🎁 [Link]({$viewUrl})\n\n✨ **Fitur unggulan panduan:**\n🚀 Jadwal ter-update\n🗺️ Peta detail semua rute\n💳 Info pembayaran cashless\n📞 Kontak darurat\n\nPanduan ini akan menjawab semua pertanyaan Anda tentang KRL {$cityName}!"
        ];
        
        return $responses[array_rand($responses)];
    }
    
    /**
     * Detect query type for more contextual responses
     */
    private function detectQueryType(string $message): string
    {
        $message = strtolower($message);
        
        if (strpos($message, 'jadwal') !== false || strpos($message, 'schedule') !== false) {
            return 'schedule';
        }
        if (strpos($message, 'tarif') !== false || strpos($message, 'harga') !== false || strpos($message, 'price') !== false) {
            return 'price';
        }
        if (strpos($message, 'rute') !== false || strpos($message, 'route') !== false || strpos($message, 'jalur') !== false) {
            return 'route';
        }
        if (strpos($message, 'stasiun') !== false || strpos($message, 'station') !== false) {
            return 'station';
        }
        
        return 'general';
    }
    
    /**
     * Generate general commuter line response when no specific city is mentioned
     */
    private function generateGeneralCommuterLineResponse(string $originalMessage): string
    {
        // Generate secure view links
        $jabodetabekUrl = route('view.panduan', 'jabodetabek');
        $bandungUrl = route('view.panduan', 'bandung');
        $surabayaUrl = route('view.panduan', 'surabaya');
        $yogyakartaUrl = route('view.panduan', 'yogyakarta');
        
        $responses = [
            "🚆 **KRL Commuter Line - Layanan Kereta Perkotaan KAI**\n\nKAI menyediakan layanan KRL Commuter Line di beberapa kota besar. Saya memiliki panduan lengkap untuk:\n\n🏙️ **Jabodetabek** - [Link]({$jabodetabekUrl})\n🌸 **Bandung** - [Link]({$bandungUrl})\n🦅 **Surabaya** - [Link]({$surabayaUrl})\n🏛️ **Yogyakarta** - [Link]({$yogyakartaUrl})\n\nSilakan pilih kota yang Anda butuhkan, atau tanyakan langsung tentang KRL di kota tertentu!",
            
            "🚄 **Informasi KRL Commuter Line KAI**\n\nKRL Commuter Line hadir di 4 kota besar Indonesia. Berikut panduan lengkap yang tersedia:\n\n📋 **Panduan KRL Tersedia:**\n• **Jakarta & Sekitarnya** - [Link]({$jabodetabekUrl})\n• **Bandung** - [Link]({$bandungUrl})\n• **Surabaya** - [Link]({$surabayaUrl})\n• **Yogyakarta** - [Link]({$yogyakartaUrl})\n\nMau tahu info KRL di kota mana? Sebutkan kotanya dan saya akan berikan panduan detailnya!"
        ];
        
        return $responses[array_rand($responses)];
    }

    /**
     * Check if message is KAI-related using keyword matching
     */
    private function isKaiRelated(string $message): bool
    {
        foreach ($this->kaiKeywords as $keyword) {
            if (strpos($message, $keyword) !== false) {
                return true;
            }
        }
        return false;
    }

    /**
     * Advanced NLP Intent Classification System
     */
    private function generateKaiResponseFromDatabase(string $message): string
    {
        // Step 1: Initial intent classification
        $intent = $this->classifyIntent($message);
        
        // Step 2: Context-aware refinement
        $refinedIntent = $this->refineIntentWithContext($intent, $message);
        
        // Step 3: Route to appropriate handler
        switch ($refinedIntent['type']) {
            case 'schedule':
                return $this->getScheduleResponse($message);
            case 'service':
                return $this->getServicesResponse();
            case 'news':
                return $this->getNewsResponse($message);
            case 'about':
                return $this->getAboutResponse();
            case 'station':
                return $this->getStationResponse($message);
            case 'route':
                return $this->getRouteResponse($message);
            case 'specific_route':
                return $this->getSpecificRouteResponse($refinedIntent['from'], $refinedIntent['to']);
            default:
                return $this->getRandomResponse('default');
        }
    }

    /**
     * Advanced Intent Classification with NLP techniques
     */
    private function classifyIntent(string $message): array
    {
        $message = strtolower(trim($message));
        $words = $this->tokenizeAndClean($message);
        
        // Define intent patterns with weighted scoring
        $intentPatterns = [
            'schedule' => [
                'primary_keywords' => ['jadwal', 'schedule', 'jam', 'waktu', 'keberangkatan', 'tiba', 'departure', 'arrival'],
                'secondary_keywords' => ['kapan', 'when', 'pukul', 'time'],
                'context_keywords' => ['kereta', 'train', 'perjalanan', 'trip'],
                'negative_keywords' => ['berita', 'layanan', 'tentang', 'profil']
            ],
            'service' => [
                'primary_keywords' => ['layanan', 'service', 'fasilitas', 'facility', 'pelayanan'],
                'secondary_keywords' => ['apa', 'what', 'jenis', 'macam', 'tersedia', 'available'],
                'context_keywords' => ['kai', 'kereta', 'train'],
                'negative_keywords' => ['berita', 'jadwal', 'harga', 'tarif']
            ],
            'news' => [
                'primary_keywords' => ['berita', 'news', 'kabar', 'update', 'terbaru', 'latest'],
                'secondary_keywords' => ['informasi', 'info', 'pengumuman', 'announcement'],
                'context_keywords' => ['kai', 'kereta'],
                'negative_keywords' => ['layanan', 'jadwal', 'harga']
            ],
            'about' => [
                'primary_keywords' => ['tentang', 'about', 'profil', 'profile', 'sejarah', 'history'],
                'secondary_keywords' => ['apa', 'what', 'siapa', 'who'],
                'context_keywords' => ['kai', 'perusahaan', 'company'],
                'negative_keywords' => ['berita', 'layanan', 'jadwal']
            ],
            'station' => [
                'primary_keywords' => ['stasiun', 'station', 'terminal'],
                'secondary_keywords' => ['dimana', 'where', 'lokasi', 'location', 'alamat', 'address'],
                'context_keywords' => ['kereta', 'train'],
                'negative_keywords' => ['berita', 'layanan']
            ],
            'route' => [
                'primary_keywords' => ['rute', 'route', 'jalur', 'harga', 'tarif', 'price', 'biaya', 'cost'],
                'secondary_keywords' => ['berapa', 'how much', 'mahal', 'murah'],
                'context_keywords' => ['kereta', 'train', 'perjalanan'],
                'negative_keywords' => ['berita', 'layanan', 'tentang']
            ]
        ];

        // Calculate intent scores
        $scores = [];
        foreach ($intentPatterns as $intent => $patterns) {
            $scores[$intent] = $this->calculateIntentScore($words, $patterns);
        }

        // Check for specific route pattern (dari X ke Y)
        if (preg_match('/dari\s+(\w+)\s+ke\s+(\w+)|(\w+)\s+ke\s+(\w+)/', $message, $matches)) {
            $from = $matches[1] ?? $matches[3] ?? '';
            $to = $matches[2] ?? $matches[4] ?? '';
            return [
                'type' => 'specific_route',
                'confidence' => 0.95,
                'from' => $from,
                'to' => $to
            ];
        }

        // Find highest scoring intent
        arsort($scores);
        $topIntent = array_key_first($scores);
        $confidence = $scores[$topIntent];

        // Minimum confidence threshold
        if ($confidence < 0.3) {
            return ['type' => 'default', 'confidence' => 0];
        }

        return [
            'type' => $topIntent,
            'confidence' => $confidence,
            'scores' => $scores
        ];
    }

    /**
     * Calculate weighted score for intent classification
     */
    private function calculateIntentScore(array $words, array $patterns): float
    {
        $score = 0;
        $totalWords = count($words);
        
        if ($totalWords == 0) return 0;

        // Primary keywords (highest weight)
        foreach ($patterns['primary_keywords'] as $keyword) {
            if (in_array($keyword, $words)) {
                $score += 3.0;
            }
        }

        // Secondary keywords (medium weight)
        foreach ($patterns['secondary_keywords'] as $keyword) {
            if (in_array($keyword, $words)) {
                $score += 1.5;
            }
        }

        // Context keywords (low weight but important)
        foreach ($patterns['context_keywords'] as $keyword) {
            if (in_array($keyword, $words)) {
                $score += 0.5;
            }
        }

        // Negative keywords (penalty)
        foreach ($patterns['negative_keywords'] as $keyword) {
            if (in_array($keyword, $words)) {
                $score -= 2.0;
            }
        }

        // Normalize score by message length
        return max(0, $score / ($totalWords + 1));
    }

    /**
     * Advanced text preprocessing and tokenization
     */
    private function tokenizeAndClean(string $text): array
    {
        // Convert to lowercase
        $text = strtolower($text);
        
        // Remove punctuation except important ones
        $text = preg_replace('/[^\w\s\-]/', ' ', $text);
        
        // Handle common Indonesian contractions and variations
        $replacements = [
            'gimana' => 'bagaimana',
            'gmn' => 'bagaimana',
            'brp' => 'berapa',
            'dmn' => 'dimana',
            'kpn' => 'kapan',
            'jdwl' => 'jadwal',
            'hrg' => 'harga',
            'info' => 'informasi',
            'yg' => 'yang',
            'dgn' => 'dengan',
            'utk' => 'untuk',
            'dr' => 'dari',
            'ke' => 'ke',
            'sm' => 'sama'
        ];
        
        foreach ($replacements as $short => $full) {
            $text = str_replace($short, $full, $text);
        }
        
        // Split into words and remove empty/short words
        $words = array_filter(explode(' ', $text), function($word) {
            return strlen(trim($word)) > 1;
        });
        
        // Remove common stop words that don't add meaning
        $stopWords = ['dan', 'atau', 'dengan', 'untuk', 'dari', 'ke', 'di', 'pada', 'yang', 'adalah', 'ini', 'itu', 'saya', 'anda'];
        $words = array_diff($words, $stopWords);
        
        return array_values($words);
    }

    /**
     * Context-aware intent refinement
     */
    private function refineIntentWithContext(array $intent, string $originalMessage): array
    {
        // If confidence is low, try semantic similarity
        if ($intent['confidence'] < 0.5) {
            $semanticIntent = $this->semanticIntentMatching($originalMessage);
            if ($semanticIntent['confidence'] > $intent['confidence']) {
                return $semanticIntent;
            }
        }

        // Context-based refinement rules
        $message = strtolower($originalMessage);
        
        // If asking about "informasi layanan" - should be service, not news
        if (strpos($message, 'informasi') !== false && strpos($message, 'layanan') !== false) {
            return ['type' => 'service', 'confidence' => 0.9];
        }
        
        // If asking about "layanan apa" - definitely service
        if (preg_match('/layanan\s+(apa|what|mana)/', $message)) {
            return ['type' => 'service', 'confidence' => 0.95];
        }
        
        // If asking about "berita terbaru" - definitely news
        if (strpos($message, 'berita') !== false && (strpos($message, 'terbaru') !== false || strpos($message, 'update') !== false)) {
            return ['type' => 'news', 'confidence' => 0.95];
        }

        return $intent;
    }

    /**
     * Semantic similarity matching for better intent detection
     */
    private function semanticIntentMatching(string $message): array
    {
        $semanticPatterns = [
            'service' => [
                'apa saja layanan kai',
                'layanan apa yang tersedia',
                'fasilitas apa yang ada',
                'pelayanan kai seperti apa',
                'jenis layanan kereta api',
                'service yang disediakan kai'
            ],
            'news' => [
                'berita terbaru kai',
                'kabar terkini kereta api',
                'update informasi kai',
                'pengumuman dari kai',
                'news kereta api indonesia'
            ],
            'schedule' => [
                'jadwal kereta api',
                'jam keberangkatan kereta',
                'waktu perjalanan kereta',
                'schedule kereta api',
                'kapan kereta berangkat'
            ],
            'route' => [
                'harga tiket kereta',
                'tarif perjalanan kereta',
                'biaya naik kereta',
                'rute perjalanan kereta',
                'jalur kereta api'
            ]
        ];

        $bestMatch = ['type' => 'default', 'confidence' => 0];
        $message = strtolower($message);

        foreach ($semanticPatterns as $intent => $patterns) {
            foreach ($patterns as $pattern) {
                $similarity = $this->calculateStringSimilarity($message, $pattern);
                if ($similarity > $bestMatch['confidence']) {
                    $bestMatch = [
                        'type' => $intent,
                        'confidence' => $similarity
                    ];
                }
            }
        }

        return $bestMatch;
    }

    /**
     * Calculate string similarity using Levenshtein distance
     */
    private function calculateStringSimilarity(string $str1, string $str2): float
    {
        $len1 = strlen($str1);
        $len2 = strlen($str2);
        
        if ($len1 == 0) return $len2 == 0 ? 1 : 0;
        if ($len2 == 0) return 0;
        
        $distance = levenshtein($str1, $str2);
        $maxLen = max($len1, $len2);
        
        return 1 - ($distance / $maxLen);
    }

    /**
     * Check if query is too general or simple
     */
    private function isGeneralOrSimpleQuery(string $message): bool
    {
        $generalQueries = [
            'hai', 'halo', 'hello', 'hi', 'selamat', 'pagi', 'siang', 'sore', 'malam',
            'apa kabar', 'bagaimana', 'gimana', 'kenapa', 'mengapa', 'siapa', 'dimana',
            'kapan', 'berapa', 'ya', 'iya', 'tidak', 'gak', 'nggak', 'ok', 'oke',
            'terima kasih', 'thanks', 'makasih', 'baik', 'bagus', 'jelek', 'buruk',
            'help', 'bantuan', 'tolong', 'bisa', 'mau', 'ingin', 'pengen'
        ];

        if (strlen(trim($message)) < 3) {
            return true;
        }

        $words = explode(' ', $message);
        $generalWordCount = 0;
        
        foreach ($words as $word) {
            if (in_array(trim($word), $generalQueries)) {
                $generalWordCount++;
            }
        }

        if (count($words) > 0 && ($generalWordCount / count($words)) > 0.7) {
            return true;
        }

        $genericPatterns = [
            '/^(apa|what|bagaimana|how|kenapa|why|siapa|who|dimana|where|kapan|when)\s*\?*$/i',
            '/^(hai|halo|hello|hi)$/i',
            '/^(ya|iya|tidak|gak|nggak|ok|oke)$/i',
        ];

        foreach ($genericPatterns as $pattern) {
            if (preg_match($pattern, trim($message))) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if KAI response is too generic
     */
    private function isGenericKaiResponse(string $response): bool
    {
        $genericResponses = [
            'Terima kasih telah menghubungi layanan chatbot KAI',
            'Halo! Saya siap membantu Anda',
            'Selamat datang di layanan chatbot KAI'
        ];

        foreach ($genericResponses as $generic) {
            if (strpos($response, $generic) !== false) {
                return true;
            }
        }

        return false;
    }

    /**
     * Handle external API queries using RapidAPI
     */
    private function handleExternalQuery(string $message): string
    {
        $externalApiKey = '18c4b2fd16msh32d393319e95b02p1ebdb6jsncda25d8eb8d3';
        $externalApiHost = 'chatgpt-42.p.rapidapi.com';
        $externalApiUrl = 'https://chatgpt-42.p.rapidapi.com';
        $externalApiEndpoint = '/matag2';

        try {
            $fullApiUrl = $externalApiUrl . $externalApiEndpoint;
            
            $response = Http::timeout(15)
                ->withHeaders([
                    'X-RapidAPI-Key' => $externalApiKey,
                    'X-RapidAPI-Host' => $externalApiHost,
                    'Content-Type' => 'application/json'
                ])
                ->post($fullApiUrl, [
                    'message' => $message,
                    'web_access' => false
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $result = $data['result'] ?? $data['response'] ?? $data['answer'] ?? $data['message'] ?? null;
                
                if ($result) {
                    return "🤖 **Jawaban AI:**\n\n" . $result . "\n\n*Catatan: Untuk informasi spesifik tentang KAI, silakan tanyakan dengan kata kunci seperti 'jadwal KAI', 'harga tiket', 'stasiun', atau 'layanan KAI'.*";
                } else {
                    return 'Maaf, tidak dapat memproses pertanyaan Anda saat ini. Silakan coba dengan pertanyaan yang lebih spesifik.';
                }
            } else {
                return "Maaf, layanan AI sedang tidak tersedia. Silakan coba lagi nanti atau hubungi customer service kami di 1500000.";
            }
        } catch (\Exception $e) {
            return "Pertanyaan Anda di luar informasi KAI. Untuk bantuan lebih lanjut, silakan hubungi customer service kami di 1500000.";
        }
    }


    /**
     * Get random response from category
     */
    private function getRandomResponse(string $category): string
    {
        $responses = $this->kaiResponses[$category] ?? $this->kaiResponses['default'];
        return $responses[array_rand($responses)];
    }

    /**
     * Save chat history
     */
    private function saveChatHistory(string $sessionId, string $sender, string $message): void
    {
        try {
            ChatHistory::create([
                'session_id' => $sessionId,
                'sender' => $sender,
                'message' => $message,
                'created_at' => now()
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save chat history: ' . $e->getMessage());
        }
    }

    /**
     * Get chat history for a session
     */
    public function getHistory(Request $request): JsonResponse
    {
        try {
            $sessionId = $request->input('session_id', session()->getId());
            
            $history = ChatHistory::where('session_id', $sessionId)
                ->orderBy('created_at', 'asc')
                ->take(50) // Limit to last 50 messages
                ->get();

            return response()->json([
                'success' => true,
                'history' => $history,
                'session_id' => $sessionId
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to get chat history: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Clear chat history for a session
     */
    public function clearHistory(Request $request): JsonResponse
    {
        try {
            $sessionId = $request->input('session_id', session()->getId());
            
            ChatHistory::where('session_id', $sessionId)->delete();

            return response()->json([
                'success' => true,
                'message' => 'Chat history cleared successfully'
            ]);

        } catch (\Exception $e) {
            Log::error('Failed to clear chat history: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get news response from database
     */
    private function getNewsResponse(string $message): string
    {
        try {
            $news = KaiNews::latest()->take(5)->get();
            
            if ($news->isEmpty()) {
                return "Maaf, tidak ada berita terbaru saat ini. Silakan kunjungi website resmi KAI untuk informasi terkini.";
            }

            $response = "📰 **Berita Terbaru KAI:**\n\n";
            foreach ($news as $index => $item) {
                $response .= ($index + 1) . ". **{$item->judul}**\n";
                $response .= "   📅 {$item->tanggal->format('d M Y')} | ✍️ {$item->penulis}\n";
                $response .= "   " . substr(strip_tags($item->isi), 0, 100) . "...\n\n";
            }
            
            $response .= "*Untuk membaca berita lengkap, kunjungi halaman berita di website KAI.*";
            return $response;
        } catch (\Exception $e) {
            Log::error('Error getting news: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mengambil data berita. Silakan coba lagi nanti.";
        }
    }

    /**
     * Get services response from database
     */
    private function getServicesResponse(): string
    {
        try {
            $services = KaiService::all();
            
            if ($services->isEmpty()) {
                return "Maaf, informasi layanan tidak tersedia saat ini.";
            }

            $response = "🚄 **Layanan KAI:**\n\n";
            foreach ($services as $index => $service) {
                $response .= ($index + 1) . ". **{$service->nama_layanan}**\n";
                $response .= "   " . strip_tags($service->deskripsi) . "\n\n";
            }
            
            return $response;
        } catch (\Exception $e) {
            Log::error('Error getting services: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mengambil data layanan. Silakan coba lagi nanti.";
        }
    }

    /**
     * Get about/profile response from database
     */
    private function getAboutResponse(): string
    {
        try {
            $about = KaiAbout::first();
            $profile = KaiProfile::first();
            
            $response = "🏢 **Tentang PT Kereta Api Indonesia (KAI):**\n\n";
            
            if ($about) {
                $response .= "**Visi:** " . $about->visi . "\n\n";
                $response .= "**Misi:** " . $about->misi . "\n\n";
                $response .= "**Sejarah:** " . substr(strip_tags($about->sejarah), 0, 200) . "...\n\n";
            }
            
            if ($profile) {
                $response .= "**Informasi Perusahaan:**\n";
                $response .= "📍 Alamat: " . $profile->alamat . "\n";
                $response .= "📞 Telepon: " . $profile->telepon . "\n";
                $response .= "📧 Email: " . $profile->email . "\n";
                $response .= "🌐 Website: " . $profile->website . "\n\n";
            }
            
            return $response;
        } catch (\Exception $e) {
            Log::error('Error getting about info: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mengambil informasi perusahaan. Silakan coba lagi nanti.";
        }
    }

    /**
     * Get station response from database
     */
    private function getStationResponse(string $message): string
    {
        try {
            // Check if specific city is mentioned
            $cities = ['jakarta', 'bandung', 'surabaya', 'yogyakarta', 'semarang', 'solo', 'malang', 'cirebon'];
            $targetCity = null;
            
            foreach ($cities as $city) {
                if (strpos($message, $city) !== false) {
                    $targetCity = $city;
                    break;
                }
            }
            
            if ($targetCity) {
                $stations = Station::where('city', 'LIKE', '%' . $targetCity . '%')
                    ->active()
                    ->take(10)
                    ->get();
                    
                if ($stations->isNotEmpty()) {
                    $response = "🚉 **Stasiun KAI di " . ucfirst($targetCity) . ":**\n\n";
                    foreach ($stations as $index => $station) {
                        $response .= ($index + 1) . ". **{$station->name}** ({$station->code})\n";
                        $response .= "   📍 {$station->city}, {$station->province}\n\n";
                    }
                    return $response;
                }
            }
            
            // General station info
            $totalStations = Station::active()->count();
            $provinces = Station::active()->distinct('province')->pluck('province')->take(10);
            
            $response = "🚉 **Informasi Stasiun KAI:**\n\n";
            $response .= "📊 Total stasiun aktif: **{$totalStations}** stasiun\n\n";
            $response .= "🗺️ **Provinsi yang dilayani:**\n";
            foreach ($provinces as $index => $province) {
                $response .= ($index + 1) . ". {$province}\n";
            }
            $response .= "\n*Sebutkan nama kota untuk melihat stasiun spesifik di kota tersebut.*";
            
            return $response;
        } catch (\Exception $e) {
            Log::error('Error getting station info: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mengambil data stasiun. Silakan coba lagi nanti.";
        }
    }

    /**
     * Get schedule response from database
     */
    private function getScheduleResponse(string $message): string
    {
        try {
            $schedules = Schedule::with(['route.originStation', 'route.destinationStation'])
                ->take(10)
                ->get();
            
            if ($schedules->isEmpty()) {
                return "Maaf, data jadwal tidak tersedia saat ini. Silakan cek aplikasi KAI Access untuk jadwal terkini.";
            }

            $response = "🕐 **Contoh Jadwal Kereta KAI:**\n\n";
            $response .= "| Kereta | Rute | Berangkat | Tiba |\n";
            $response .= "|--------|------|-----------|------|\n";
            
            foreach ($schedules->take(5) as $schedule) {
                $origin = $schedule->route->originStation->name ?? 'N/A';
                $destination = $schedule->route->destinationStation->name ?? 'N/A';
                $departure = $schedule->departure_time ? $schedule->departure_time->format('H:i') : 'N/A';
                $arrival = $schedule->arrival_time ? $schedule->arrival_time->format('H:i') : 'N/A';
                
                $response .= "| {$schedule->train_name} | {$origin} - {$destination} | {$departure} | {$arrival} |\n";
            }
            
            $response .= "\n*Untuk jadwal lengkap dan terkini, gunakan aplikasi KAI Access atau website resmi KAI.*";
            return $response;
        } catch (\Exception $e) {
            Log::error('Error getting schedule info: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mengambil data jadwal. Silakan coba lagi nanti.";
        }
    }

    /**
     * Get route response from database
     */
    private function getRouteResponse(string $message): string
    {
        try {
            $routes = Route::with(['originStation', 'destinationStation'])
                ->active()
                ->take(10)
                ->get();
            
            if ($routes->isEmpty()) {
                return "Maaf, data rute tidak tersedia saat ini.";
            }

            $response = "🛤️ **Rute dan Harga KAI:**\n\n";
            $response .= "| Rute | Jarak | Harga Dasar | Durasi |\n";
            $response .= "|------|-------|-------------|--------|\n";
            
            foreach ($routes->take(8) as $route) {
                $routeName = $route->route_name ?? 'N/A';
                $distance = $route->distance_km ? $route->distance_km . ' km' : 'N/A';
                $price = $route->base_price ? 'Rp ' . number_format($route->base_price, 0, ',', '.') : 'N/A';
                $duration = $route->formatted_duration ?? 'N/A';
                
                $response .= "| {$routeName} | {$distance} | {$price} | {$duration} |\n";
            }
            
            $response .= "\n*Harga dapat berbeda tergantung kelas dan waktu perjalanan. Cek harga terkini di KAI Access.*";
            return $response;
        } catch (\Exception $e) {
            Log::error('Error getting route info: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mengambil data rute. Silakan coba lagi nanti.";
        }
    }

    /**
     * Get specific route response
     */
    private function getSpecificRouteResponse(string $from, string $to): string
    {
        try {
            $fromStation = Station::where('name', 'LIKE', '%' . $from . '%')
                ->orWhere('city', 'LIKE', '%' . $from . '%')
                ->first();
                
            $toStation = Station::where('name', 'LIKE', '%' . $to . '%')
                ->orWhere('city', 'LIKE', '%' . $to . '%')
                ->first();
            
            if (!$fromStation || !$toStation) {
                return "Maaf, stasiun {$from} atau {$to} tidak ditemukan. Silakan periksa ejaan atau gunakan nama kota yang lebih umum.";
            }
            
            $routes = Route::where('origin_station_id', $fromStation->id)
                ->where('destination_station_id', $toStation->id)
                ->with(['schedules'])
                ->active()
                ->get();
            
            if ($routes->isEmpty()) {
                return "Maaf, tidak ada rute langsung dari {$fromStation->name} ke {$toStation->name}. Silakan cek rute alternatif di aplikasi KAI Access.";
            }
            
            $response = "🚄 **Rute {$fromStation->name} → {$toStation->name}:**\n\n";
            
            foreach ($routes as $route) {
                $response .= "📍 **Jarak:** {$route->distance_km} km\n";
                $response .= "💰 **Harga Dasar:** Rp " . number_format($route->base_price, 0, ',', '.') . "\n";
                $response .= "⏱️ **Estimasi Waktu:** {$route->formatted_duration}\n\n";
                
                if ($route->schedules->isNotEmpty()) {
                    $response .= "🕐 **Jadwal Tersedia:**\n";
                    foreach ($route->schedules->take(3) as $schedule) {
                        $departure = $schedule->departure_time ? $schedule->departure_time->format('H:i') : 'N/A';
                        $arrival = $schedule->arrival_time ? $schedule->arrival_time->format('H:i') : 'N/A';
                        $response .= "• {$schedule->train_name}: {$departure} - {$arrival}\n";
                    }
                }
            }
            
            $response .= "\n*Untuk booking dan informasi lengkap, gunakan aplikasi KAI Access.*";
            return $response;
        } catch (\Exception $e) {
            Log::error('Error getting specific route: ' . $e->getMessage());
            return "Maaf, terjadi kesalahan saat mencari rute. Silakan coba lagi nanti.";
        }
    }

    /**
     * View Panduan PDF in browser dengan secure link
     */
    public function viewPanduan(Request $request, string $type)
    {
        // Define allowed PDF types and their corresponding files
        $pdfMappings = [
            'jabodetabek' => 'Comuter-KAI-Line-Jabodetabek.pdf',
            'bandung' => 'Comuter-KAI-Line-Bandung.pdf',
            'surabaya' => 'Comuter-KAI-Line-Surabaya.pdf',
            'yogyakarta' => 'Comuter-KAI-Line-Yogyakarta.pdf'
        ];

        // Validate PDF type
        if (!array_key_exists($type, $pdfMappings)) {
            abort(404, 'Panduan tidak ditemukan');
        }

        $fileName = $pdfMappings[$type];
        $filePath = public_path('assets/' . $fileName);

        // Check if file exists
        if (!file_exists($filePath)) {
            abort(404, 'File panduan tidak ditemukan');
        }

        // Return PDF file to be viewed in browser
        return response()->file($filePath, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="' . $fileName . '"'
        ]);
    }
}
