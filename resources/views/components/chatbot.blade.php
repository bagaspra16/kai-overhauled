<!-- Chatbot Floating Button & Modal -->
<!-- Floating Chatbot -->
<div x-data="chatbot()" 
     class="fixed bottom-6 right-6 z-50 chatbot-container" 
     :class="{ 'initialized': isInitialized }"
     :data-initialized="isInitialized">
    <!-- Floating Button -->
    <div class="relative">
        <!-- Notification Badge -->
        <div x-show="hasUnreadMessages" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-0"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-0"
             class="absolute -top-2 -right-2 w-6 h-6 bg-red-500 text-white text-xs rounded-full flex items-center justify-center animate-pulse z-10">
            !
        </div>

        <!-- Main Button -->
        <button @click="toggleChat()" 
                class="group relative w-16 h-16 bg-gradient-to-br from-kai-blue to-kai-blue-light text-white rounded-2xl shadow-2xl hover:shadow-3xl transform hover:scale-110 transition-all duration-300 overflow-hidden"
                :class="{ 'rotate-180': isOpen }">
            
            <!-- Background Animation -->
            <div class="absolute inset-0 bg-gradient-to-br from-kai-orange to-kai-orange-light opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Icon -->
            <div class="relative z-10 flex items-center justify-center h-full">
                <i x-show="!isOpen" 
                   x-transition:enter="transition ease-out duration-200"
                   x-transition:enter-start="opacity-0 rotate-180"
                   x-transition:enter-end="opacity-100 rotate-0"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="opacity-100 rotate-0"
                   x-transition:leave-end="opacity-0 rotate-180"
                   class="fas fa-comments text-2xl group-hover:scale-110 transition-transform duration-300"></i>
                
                <i x-show="isOpen" 
                   x-transition:enter="transition ease-out duration-200"
                   x-transition:enter-start="opacity-0 rotate-180"
                   x-transition:enter-end="opacity-100 rotate-0"
                   x-transition:leave="transition ease-in duration-200"
                   x-transition:leave-start="opacity-100 rotate-0"
                   x-transition:leave-end="opacity-0 rotate-180"
                   class="fas fa-times text-2xl group-hover:scale-110 transition-transform duration-300"></i>
            </div>

            <!-- Ripple Effect -->
            <div class="absolute inset-0 rounded-2xl">
                <div class="absolute inset-0 rounded-2xl bg-white opacity-0 group-active:opacity-20 transition-opacity duration-150"></div>
            </div>
        </button>

        <!-- Tooltip -->
        <div x-show="!isOpen && showTooltip" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 translate-x-2"
             x-transition:enter-end="opacity-100 translate-x-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-x-0"
             x-transition:leave-end="opacity-0 translate-x-2"
             class="absolute right-20 top-1/2 transform -translate-y-1/2 bg-gray-900 text-white px-3 py-2 rounded-lg text-sm whitespace-nowrap shadow-lg">
            Ada yang bisa saya bantu?
            <div class="absolute right-0 top-1/2 transform translate-x-1 -translate-y-1/2 w-2 h-2 bg-gray-900 rotate-45"></div>
        </div>
    </div>

    <!-- Chat Modal -->
    <div x-show="isOpen && isInitialized" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 transform translate-y-4 scale-95"
         class="absolute bottom-20 right-0 w-[28rem] h-[36rem] max-w-[calc(100vw-2rem)] max-h-[calc(100vh-8rem)] bg-white rounded-2xl shadow-2xl border border-gray-200 overflow-hidden flex flex-col"
         :class="{ 'chatbot-modal': true }"
         @click.away="closeChat()"
         style="display: none;"
         x-cloak>
        
        <!-- Sticky Header -->
        <div class="sticky top-0 z-10 bg-gradient-to-r from-kai-blue to-kai-blue-light text-white p-4 flex items-center justify-between rounded-t-2xl shadow-lg">
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <img src="/k-ai.png" alt="K-AI Logo" class="w-10 h-10 object-contain">
                    <div class="absolute -bottom-1 -right-1 w-4 h-4 bg-green-400 rounded-full border-2 border-white"></div>
                </div>
                <div>
                    <h3 class="font-semibold text-lg">K-AI</h3>
                    <p class="text-xs text-white/80">Online - Siap membantu Anda</p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button @click="showDeleteConfirmation()" 
                        class="p-2 hover:bg-white/10 rounded-lg transition-colors duration-200"
                        title="Clear Chat">
                    <i class="fas fa-trash text-sm"></i>
                </button>
                <button @click="closeChat()" 
                        class="p-2 hover:bg-white/10 rounded-lg transition-colors duration-200">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
        </div>

        <!-- Messages Container -->
        <div class="flex-1 overflow-y-auto p-4 space-y-4 bg-gray-50 chatbot-messages" 
             x-ref="messagesContainer"
             style="scrollbar-width: thin; scrollbar-color: #cbd5e1 transparent;">
            
            <!-- Welcome Message -->
            <div x-show="messages.length === 0" class="text-center py-8">
                    <img src="/k-ai.png" alt="K-AI Logo" class="w-16 h-16 object-contain flex items-center justify-center mx-auto mb-4 p-2">
                <h4 class="font-semibold text-gray-800 mb-2">Selamat datang di KAI Assistant!</h4>
                <p class="text-gray-600 text-sm">Saya siap membantu Anda dengan informasi seputar layanan kereta api KAI.</p>
            </div>

            <!-- Messages -->
            <template x-for="(message, index) in messages" :key="index">
                <div class="flex" :class="message.sender === 'user' ? 'justify-end' : 'justify-start'">
                    <div class="max-w-xs lg:max-w-md px-4 py-3 rounded-2xl shadow-sm"
                         :class="message.sender === 'user' 
                             ? 'bg-kai-blue text-white rounded-br-md' 
                             : 'bg-white text-gray-800 rounded-bl-md border border-gray-200'">
                        
                        <!-- Bot Avatar -->
                        <div x-show="message.sender === 'bot'" class="flex items-start space-x-2">
                            <div class="w-8 h-8 bg-kai-blue/10 rounded-full flex items-center justify-center flex-shrink-0 mt-1 p-1">
                                <img src="/k-ai.png" alt="K-AI" class="w-6 h-6 object-contain">
                            </div>
                            <div class="flex-1">
                                <div class="text-sm leading-relaxed chatbot-message" x-html="formatMessage(message.text)"></div>
                                <span class="text-xs text-gray-500 mt-1 block" x-text="formatTime(message.timestamp)"></span>
                            </div>
                        </div>

                        <!-- User Message -->
                        <div x-show="message.sender === 'user'">
                            <p class="text-sm leading-relaxed" x-text="message.text"></p>
                            <span class="text-xs text-white/70 mt-1 block" x-text="formatTime(message.timestamp)"></span>
                        </div>
                    </div>
                </div>
            </template>

            <!-- Typing Indicator -->
            <div x-show="isTyping" class="flex justify-start">
                <div class="bg-white text-gray-800 px-4 py-3 rounded-2xl rounded-bl-md shadow-sm border border-gray-200">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-kai-blue/10 rounded-full flex items-center justify-center p-1">
                            <img src="/k-ai.png" alt="K-AI" class="w-6 h-6 object-contain">
                        </div>
                        <div class="flex space-x-1">
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.1s;"></div>
                            <div class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Footer - Input Area -->
        <div class="sticky bottom-0 z-10 p-4 border-t border-gray-200 bg-white rounded-b-2xl shadow-lg">
            <form @submit.prevent="sendMessage()" class="flex items-end space-x-3">
                <div class="flex-1 relative">
                    <textarea x-model="currentMessage" 
                              x-ref="messageInput"
                              @keydown.enter.prevent="!$event.shiftKey && sendMessage()"
                              @input="autoResize()"
                              placeholder="Ketik pesan Anda..."
                              class="w-full px-4 py-3 pr-12 border border-gray-300 rounded-2xl focus:ring-2 focus:ring-kai-blue focus:border-transparent resize-none transition-all duration-200"
                              rows="1"
                              style="max-height: 120px;"
                              :disabled="isTyping"></textarea>
                    
                    <!-- Character Count -->
                    <div class="absolute bottom-2 right-3 text-xs text-gray-400" 
                         x-show="currentMessage.length > 0"
                         x-text="currentMessage.length + '/1000'"></div>
                </div>
                
                <button type="submit" 
                        :disabled="!currentMessage.trim() || isTyping"
                        class="w-12 h-12 bg-kai-blue hover:bg-kai-blue-light disabled:bg-gray-300 text-white rounded-2xl flex items-center justify-center transition-all duration-200 transform hover:scale-105 disabled:scale-100 disabled:cursor-not-allowed">
                    <i class="fas fa-paper-plane text-sm" :class="{ 'animate-pulse': isTyping }"></i>
                </button>
            </form>
            
            <!-- Quick Actions -->
            <div class="flex flex-wrap gap-2 mt-3">
                <template x-for="action in quickActions" :key="action.text">
                    <button @click="sendQuickMessage(action.text)"
                            class="px-3 py-1 text-xs bg-gray-100 hover:bg-kai-blue hover:text-white text-gray-600 rounded-full transition-all duration-200 transform hover:scale-105">
                        <i :class="action.icon" class="mr-1"></i>
                        <span x-text="action.text"></span>
                    </button>
                </template>
            </div>
        </div>

    </div>

    <!-- Modern Delete Confirmation Alert - Fixed Position Outside Modal -->
    <div x-show="showDeleteConfirm" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-full"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-full"
         class="fixed top-6 right-6 z-[9999] bg-white rounded-xl border border-gray-200 p-6 w-80 max-w-[calc(100vw-3rem)] chatbot-alert"
         style="display: none;"
         @click.away="hideDeleteConfirmation()"
         x-cloak>
        
        <!-- Alert Icon -->
        <div class="flex items-center mb-4">
            <div class="flex-shrink-0">
                <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-red-600 text-lg"></i>
                </div>
            </div>
            <div class="ml-3">
                <h3 class="text-lg font-semibold text-gray-900">Hapus Riwayat Chat</h3>
            </div>
        </div>
        
        <!-- Alert Content -->
        <div class="mb-6">
            <p class="text-sm text-gray-600">
                Apakah Anda yakin ingin menghapus semua riwayat percakapan? Tindakan ini tidak dapat dibatalkan.
            </p>
        </div>
        
        <!-- Alert Actions -->
        <div class="flex space-x-3">
            <button @click="clearChat()"
                    class="flex-1 bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-red-700 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2">
                <i class="fas fa-trash mr-2"></i>
                Hapus
            </button>
            <button @click="hideDeleteConfirmation()"
                    class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg text-sm font-medium hover:bg-gray-200 transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">
                Batal
            </button>
        </div>
    </div>
</div>

<script>
function chatbot() {
    return {
        isOpen: false,
        showTooltip: true,
        messages: [],
        currentMessage: '',
        isTyping: false,
        hasUnreadMessages: false,
        sessionId: null,
        isInitialized: false,
        showDeleteConfirm: false,
        quickActions: [
            { text: 'Jadwal Kereta', icon: 'fas fa-clock' },
            { text: 'Harga Tiket', icon: 'fas fa-money-bill' },
            { text: 'Info Stasiun', icon: 'fas fa-map-marker-alt' },
            { text: 'Cara Booking', icon: 'fas fa-ticket-alt' }
        ],

        init() {
            // Restore chat state IMMEDIATELY before any rendering
            this.restoreChatState();
            
            // Generate or restore session ID
            this.sessionId = this.getOrCreateSessionId();
            
            // Mark as initialized after a tiny delay to prevent flicker
            setTimeout(() => {
                this.isInitialized = true;
            }, 10);
            
            // Load chat history from server and localStorage
            this.$nextTick(() => {
                this.loadChatHistory();
            });
            
            // Show tooltip after delay only if chat is closed and no messages
            if (!this.isOpen && this.messages.length === 0) {
                setTimeout(() => {
                    if (!this.isOpen && this.messages.length === 0) {
                        this.showTooltip = true;
                    }
                }, 3000);

                setTimeout(() => {
                    this.showTooltip = false;
                }, 8000);
            }
            
            // Save state on page unload and navigation
            window.addEventListener('beforeunload', () => {
                this.saveChatState();
            });
            
            // Save state on page visibility change (when switching tabs/apps)
            document.addEventListener('visibilitychange', () => {
                if (document.hidden) {
                    this.saveChatState();
                }
            });
            
            // Save state periodically (every 30 seconds)
            setInterval(() => {
                this.saveChatState();
            }, 30000);
        },

        generateSessionId() {
            return 'chat_' + Date.now() + '_' + Math.random().toString(36).substr(2, 9);
        },

        getOrCreateSessionId() {
            let sessionId = localStorage.getItem('kai_chatbot_session_id');
            if (!sessionId) {
                sessionId = this.generateSessionId();
                localStorage.setItem('kai_chatbot_session_id', sessionId);
            }
            return sessionId;
        },

        saveChatState() {
            const chatState = {
                isOpen: this.isOpen,
                messages: this.messages,
                sessionId: this.sessionId,
                hasUnreadMessages: this.hasUnreadMessages,
                timestamp: Date.now()
            };
            localStorage.setItem('kai_chatbot_state', JSON.stringify(chatState));
        },

        restoreChatState() {
            try {
                const savedState = localStorage.getItem('kai_chatbot_state');
                if (savedState) {
                    const chatState = JSON.parse(savedState);
                    
                    // Only restore if saved within last 24 hours
                    const maxAge = 24 * 60 * 60 * 1000; // 24 hours in milliseconds
                    if (Date.now() - chatState.timestamp < maxAge) {
                        // Restore the actual isOpen state but only after initialization
                        this.isOpen = chatState.isOpen || false;
                        this.messages = chatState.messages || [];
                        this.sessionId = chatState.sessionId;
                        this.hasUnreadMessages = chatState.hasUnreadMessages || false;
                    } else {
                        // Clear old state
                        localStorage.removeItem('kai_chatbot_state');
                        this.isOpen = false;
                    }
                } else {
                    this.isOpen = false;
                }
            } catch (error) {
                console.warn('Failed to restore chat state:', error);
                localStorage.removeItem('kai_chatbot_state');
                this.isOpen = false;
            }
        },

        toggleChat() {
            this.isOpen = !this.isOpen;
            this.hasUnreadMessages = false;
            
            if (this.isOpen) {
                this.$nextTick(() => {
                    this.$refs.messageInput?.focus();
                    this.scrollToBottom();
                });
            }
            
            // Save state when toggling
            this.saveChatState();
        },

        closeChat() {
            this.isOpen = false;
            this.saveChatState();
        },

        async sendMessage() {
            if (!this.currentMessage.trim() || this.isTyping) return;

            const message = this.currentMessage.trim();
            this.currentMessage = '';
            
            // Add user message
            this.addMessage('user', message);
            
            // Show typing indicator
            this.isTyping = true;
            this.scrollToBottom();

            try {
                const response = await fetch('/api/chatbot/chat', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        message: message,
                        session_id: this.sessionId
                    })
                });

                const data = await response.json();

                if (data.success) {
                    // Simulate typing delay
                    setTimeout(() => {
                        this.isTyping = false;
                        this.addMessage('bot', data.response);
                        this.scrollToBottom();
                    }, 1000 + Math.random() * 1000); // 1-2 seconds delay
                } else {
                    this.isTyping = false;
                    this.addMessage('bot', 'Maaf, terjadi kesalahan. Silakan coba lagi.');
                }
            } catch (error) {
                this.isTyping = false;
                this.addMessage('bot', 'Maaf, tidak dapat terhubung ke server. Silakan coba lagi.');
                console.error('Chat error:', error);
            }
        },

        sendQuickMessage(message) {
            this.currentMessage = message;
            this.sendMessage();
        },

        addMessage(sender, text) {
            this.messages.push({
                sender: sender,
                text: text,
                timestamp: new Date()
            });

            if (!this.isOpen && sender === 'bot') {
                this.hasUnreadMessages = true;
            }
            
            // Save state after adding message
            this.saveChatState();
        },

        async loadChatHistory() {
            // If messages already loaded from localStorage, don't reload from server
            if (this.messages.length > 0) {
                this.$nextTick(() => {
                    this.scrollToBottom();
                });
                return;
            }
            
            try {
                const response = await fetch(`/api/chatbot/history?session_id=${this.sessionId}`);
                const data = await response.json();

                if (data.success && data.history.length > 0) {
                    this.messages = data.history.map(item => ({
                        sender: item.sender,
                        text: item.message,
                        timestamp: new Date(item.created_at)
                    }));
                    this.$nextTick(() => {
                        this.scrollToBottom();
                    });
                }
            } catch (error) {
                console.error('Failed to load chat history:', error);
            }
        },

        showDeleteConfirmation() {
            this.showDeleteConfirm = true;
        },

        hideDeleteConfirmation() {
            this.showDeleteConfirm = false;
        },

        async clearChat() {
            try {
                await fetch('/api/chatbot/clear', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
                    },
                    body: JSON.stringify({
                        session_id: this.sessionId
                    })
                });

                this.messages = [];
                this.hasUnreadMessages = false;
                
                // Clear localStorage
                localStorage.removeItem('kai_chatbot_state');
                localStorage.removeItem('kai_chatbot_session_id');
                
                // Generate new session ID
                this.sessionId = this.generateSessionId();
                localStorage.setItem('kai_chatbot_session_id', this.sessionId);
                
                // Save new empty state
                this.saveChatState();
                
                // Hide confirmation dialog
                this.hideDeleteConfirmation();
            } catch (error) {
                console.error('Failed to clear chat:', error);
                this.hideDeleteConfirmation();
            }
        },

        scrollToBottom() {
            this.$nextTick(() => {
                const container = this.$refs.messagesContainer;
                if (container) {
                    container.scrollTop = container.scrollHeight;
                }
            });
        },

        autoResize() {
            const textarea = this.$refs.messageInput;
            if (textarea) {
                textarea.style.height = 'auto';
                textarea.style.height = Math.min(textarea.scrollHeight, 120) + 'px';
            }
        },

        formatTime(timestamp) {
            return new Date(timestamp).toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        },

        formatMessage(text) {
            // Convert markdown-like formatting to HTML
            let formatted = text
                // Links [text](url)
                .replace(/\[([^\]]+)\]\(([^)]+)\)/g, '<a href="$2" target="_blank" rel="noopener noreferrer" class="text-kai-blue hover:text-kai-blue-dark underline">$1</a>')
                // Bold text
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                // Italic text
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                // Line breaks
                .replace(/\n/g, '<br>')
                // Emojis (keep as is)
                .replace(/([\u{1F600}-\u{1F64F}]|[\u{1F300}-\u{1F5FF}]|[\u{1F680}-\u{1F6FF}]|[\u{1F1E0}-\u{1F1FF}]|[\u{2600}-\u{26FF}]|[\u{2700}-\u{27BF}])/gu, '$1');

            // Handle tables
            if (formatted.includes('|')) {
                formatted = this.formatTable(formatted);
            }

            return formatted;
        },

        formatTable(text) {
            const lines = text.split('<br>');
            let inTable = false;
            let tableRows = [];
            let result = [];

            for (let line of lines) {
                if (line.includes('|') && line.trim() !== '') {
                    if (!inTable) {
                        inTable = true;
                        tableRows = [];
                    }
                    tableRows.push(line);
                } else {
                    if (inTable) {
                        // Process the table
                        result.push(this.createHtmlTable(tableRows));
                        inTable = false;
                        tableRows = [];
                    }
                    if (line.trim() !== '') {
                        result.push(line);
                    }
                }
            }

            // Handle table at the end
            if (inTable && tableRows.length > 0) {
                result.push(this.createHtmlTable(tableRows));
            }

            return result.join('<br>');
        },

        createHtmlTable(rows) {
            if (rows.length < 2) return rows.join('<br>');

            let html = '<div class="overflow-x-auto mt-2 mb-2"><table class="min-w-full text-xs border-collapse border border-gray-300">';
            
            // Header row
            const headerCells = rows[0].split('|').map(cell => cell.trim()).filter(cell => cell !== '');
            html += '<thead class="bg-kai-blue text-white"><tr>';
            headerCells.forEach(cell => {
                html += `<th class="border border-gray-300 px-2 py-1 text-left">${cell}</th>`;
            });
            html += '</tr></thead><tbody>';

            // Skip separator row (if exists) and process data rows
            const dataRows = rows.slice(1).filter(row => !row.includes('---'));
            dataRows.forEach((row, index) => {
                const cells = row.split('|').map(cell => cell.trim()).filter(cell => cell !== '');
                if (cells.length > 0) {
                    html += `<tr class="${index % 2 === 0 ? 'bg-gray-50' : 'bg-white'}">`;
                    cells.forEach(cell => {
                        html += `<td class="border border-gray-300 px-2 py-1">${cell}</td>`;
                    });
                    html += '</tr>';
                }
            });

            html += '</tbody></table></div>';
            return html;
        }
    }
}
</script>

<style>
/* Custom scrollbar for messages */
.chatbot-messages::-webkit-scrollbar {
    width: 4px;
}

.chatbot-messages::-webkit-scrollbar-track {
    background: transparent;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 2px;
}

.chatbot-messages::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}

/* Animation for message appearance */
@keyframes messageSlideIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.message-enter {
    animation: messageSlideIn 0.3s ease-out;
}

/* Chatbot message styling */
.chatbot-message strong {
    font-weight: 600;
    color: #1f2937;
}

.chatbot-message em {
    font-style: italic;
    color: #4b5563;
}

.chatbot-message table {
    font-size: 11px;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

.chatbot-message table th {
    font-weight: 600;
    font-size: 10px;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.chatbot-message table td {
    font-size: 11px;
}

.chatbot-message table tr:hover {
    background-color: #f8fafc !important;
}

/* Responsive table */
@media (max-width: 384px) {
    .chatbot-message table {
        font-size: 10px;
    }
    
    .chatbot-message table th,
    .chatbot-message table td {
        padding: 4px 6px;
        font-size: 9px;
    }
}

/* Chatbot modal responsive */
@media (max-width: 480px) {
    .chatbot-modal {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        right: 0 !important;
        bottom: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        max-width: none !important;
        max-height: none !important;
        border-radius: 0 !important;
    }
    
    .chatbot-modal .rounded-t-2xl {
        border-radius: 0 !important;
    }
    
    .chatbot-modal .rounded-b-2xl {
        border-radius: 0 !important;
    }
}

/* Ensure proper scrolling behavior */
.chatbot-messages {
    scrollbar-width: thin;
    scrollbar-color: rgba(203, 213, 225, 0.7) transparent;
}

.chatbot-messages::-webkit-scrollbar {
    width: 6px;
}

.chatbot-messages::-webkit-scrollbar-track {
    background: transparent;
}

.chatbot-messages::-webkit-scrollbar-thumb {
    background: rgba(203, 213, 225, 0.7);
    border-radius: 3px;
}

.chatbot-messages::-webkit-scrollbar-thumb:hover {
    background: rgba(148, 163, 184, 0.8);
}

/* Sticky header and footer shadows */
.sticky.shadow-lg {
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Enhanced shadow for footer */
.sticky.bottom-0.shadow-lg {
    box-shadow: 0 -4px 6px -1px rgba(0, 0, 0, 0.1), 0 -2px 4px -1px rgba(0, 0, 0, 0.06);
}

/* Smooth transitions for sticky elements */
.sticky {
    transition: box-shadow 0.2s ease-in-out;
}

/* Prevent chatbot flicker on page load */
[x-cloak] {
    display: none !important;
}

/* Hide entire chatbot container until initialized */
.chatbot-container {
    opacity: 0;
    transition: opacity 0.1s ease-in-out;
}

.chatbot-container.initialized {
    opacity: 1;
}

/* Ensure modal is hidden by default */
.chatbot-modal {
    transition: all 0.3s ease-out;
}

/* Additional safety - hide modal until both initialized and open */
[x-data="chatbot()"] [x-show] {
    transition-delay: 0.05s;
}

/* Modern Alert Styles - Fixed Position Outside Modal */
.chatbot-alert {
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    border: 1px solid rgba(255, 255, 255, 0.2);
}

/* Alert button hover effects */
.chatbot-alert button {
    transform: translateY(0);
    transition: all 0.2s ease;
}

.chatbot-alert button:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.chatbot-alert button:active {
    transform: translateY(0);
}

/* Alert slide animation from right */
.chatbot-alert {
    animation-duration: 0.3s;
    animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
}

/* Alert responsive - Mobile positioning */
@media (max-width: 640px) {
    .chatbot-alert {
        top: 1rem !important;
        right: 1rem !important;
        left: 1rem !important;
        width: auto !important;
        max-width: none !important;
    }
}

/* Ensure alert appears above everything */
.chatbot-alert {
    z-index: 9999 !important;
}
</style>
