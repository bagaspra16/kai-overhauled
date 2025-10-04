/**
 * KAI Cookie Helper
 * Utility functions for managing cookies and user preferences
 */

class KAICookieHelper {
    constructor() {
        this.consentKey = 'kai_cookie_consent';
        this.settingsKey = 'kai_cookie_settings';
        this.dateKey = 'kai_cookie_consent_date';
        this.expiryDays = 365;
    }

    /**
     * Check if user has given cookie consent
     */
    hasConsent() {
        return localStorage.getItem(this.consentKey) === 'accepted';
    }

    /**
     * Get cookie settings
     */
    getSettings() {
        const settings = localStorage.getItem(this.settingsKey);
        return settings ? JSON.parse(settings) : {
            essential: true,
            functional: false,
            analytics: false
        };
    }

    /**
     * Check if specific cookie type is allowed
     */
    isAllowed(type) {
        if (!this.hasConsent()) return false;
        const settings = this.getSettings();
        return settings[type] === true;
    }

    /**
     * Set a functional cookie (only if allowed)
     */
    setFunctionalCookie(name, value, days = null) {
        if (!this.isAllowed('functional')) return false;
        
        const expiry = days || this.expiryDays;
        const expires = new Date();
        expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
        
        document.cookie = `${name}=${value}; expires=${expires.toUTCString()}; path=/; SameSite=Lax`;
        return true;
    }

    /**
     * Get a cookie value
     */
    getCookie(name) {
        const nameEQ = name + "=";
        const ca = document.cookie.split(';');
        
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) === ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    /**
     * Delete a cookie
     */
    deleteCookie(name) {
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
    }

    /**
     * Save search preferences
     */
    saveSearchPreferences(preferences) {
        if (this.isAllowed('functional')) {
            this.setFunctionalCookie('kai_search_prefs', JSON.stringify(preferences), 30);
        }
    }

    /**
     * Get search preferences
     */
    getSearchPreferences() {
        if (!this.isAllowed('functional')) return null;
        
        const prefs = this.getCookie('kai_search_prefs');
        return prefs ? JSON.parse(prefs) : null;
    }

    /**
     * Track page view (only if analytics allowed)
     */
    trackPageView(page) {
        if (!this.isAllowed('analytics')) return false;
        
        // Google Analytics tracking
        if (typeof gtag !== 'undefined') {
            gtag('config', 'GA_MEASUREMENT_ID', {
                page_title: document.title,
                page_location: window.location.href
            });
        }
        
        return true;
    }

    /**
     * Track custom event (only if analytics allowed)
     */
    trackEvent(eventName, parameters = {}) {
        if (!this.isAllowed('analytics')) return false;
        
        if (typeof gtag !== 'undefined') {
            gtag('event', eventName, parameters);
        }
        
        return true;
    }

    /**
     * Initialize cookie helper
     */
    init() {
        // Set essential cookies (always allowed)
        this.setEssentialCookies();
        
        // Initialize analytics if consent given
        if (this.isAllowed('analytics')) {
            this.initializeAnalytics();
        }
        
        // Restore functional preferences
        if (this.isAllowed('functional')) {
            this.restoreFunctionalPreferences();
        }
    }

    /**
     * Set essential cookies (security, session, etc.)
     */
    setEssentialCookies() {
        // CSRF token for forms
        const csrfToken = document.querySelector('meta[name="csrf-token"]');
        if (csrfToken) {
            this.setFunctionalCookie('kai_csrf', csrfToken.getAttribute('content'), 1);
        }
        
        // Session identifier
        const sessionId = 'kai_session_' + Math.random().toString(36).substr(2, 9);
        this.setFunctionalCookie('kai_session', sessionId, 1);
    }

    /**
     * Initialize analytics
     */
    initializeAnalytics() {
        // Google Analytics initialization
        if (typeof gtag === 'undefined') {
            // Load Google Analytics if not already loaded
            const script = document.createElement('script');
            script.async = true;
            script.src = 'https://www.googletagmanager.com/gtag/js?id=GA_MEASUREMENT_ID';
            document.head.appendChild(script);
            
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());
            gtag('config', 'GA_MEASUREMENT_ID');
        }
    }

    /**
     * Restore functional preferences
     */
    restoreFunctionalPreferences() {
        // Restore search preferences
        const searchPrefs = this.getSearchPreferences();
        if (searchPrefs) {
            // Apply saved search preferences to forms
            this.applySearchPreferences(searchPrefs);
        }
        
        // Restore UI preferences
        const uiPrefs = this.getCookie('kai_ui_prefs');
        if (uiPrefs) {
            const preferences = JSON.parse(uiPrefs);
            this.applyUIPreferences(preferences);
        }
    }

    /**
     * Apply search preferences to forms
     */
    applySearchPreferences(preferences) {
        // Apply to ticket search form if exists
        const searchForm = document.querySelector('#ticket-search-form');
        if (searchForm && preferences) {
            if (preferences.defaultOrigin) {
                const originSelect = searchForm.querySelector('[name="origin"]');
                if (originSelect) originSelect.value = preferences.defaultOrigin;
            }
            
            if (preferences.defaultDestination) {
                const destSelect = searchForm.querySelector('[name="destination"]');
                if (destSelect) destSelect.value = preferences.defaultDestination;
            }
        }
    }

    /**
     * Apply UI preferences
     */
    applyUIPreferences(preferences) {
        if (preferences.theme) {
            document.body.classList.add(`theme-${preferences.theme}`);
        }
        
        if (preferences.fontSize) {
            document.body.style.fontSize = preferences.fontSize;
        }
    }

    /**
     * Clear all cookies and consent
     */
    clearAllCookies() {
        // Clear consent
        localStorage.removeItem(this.consentKey);
        localStorage.removeItem(this.settingsKey);
        localStorage.removeItem(this.dateKey);
        
        // Clear functional cookies
        this.deleteCookie('kai_search_prefs');
        this.deleteCookie('kai_ui_prefs');
        this.deleteCookie('kai_functional');
        this.deleteCookie('kai_analytics');
        this.deleteCookie('kai_session');
        
        // Reload page to reset state
        window.location.reload();
    }

    /**
     * Check if consent is expired (older than 1 year)
     */
    isConsentExpired() {
        const consentDate = localStorage.getItem(this.dateKey);
        if (!consentDate) return true;
        
        const oneYearAgo = new Date();
        oneYearAgo.setFullYear(oneYearAgo.getFullYear() - 1);
        
        return new Date(consentDate) < oneYearAgo;
    }

    /**
     * Reset expired consent
     */
    checkAndResetExpiredConsent() {
        if (this.hasConsent() && this.isConsentExpired()) {
            this.clearAllCookies();
        }
    }
}

// Initialize global cookie helper
window.KAICookies = new KAICookieHelper();

// Auto-initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    window.KAICookies.checkAndResetExpiredConsent();
    window.KAICookies.init();
});

// Export for use in other scripts
if (typeof module !== 'undefined' && module.exports) {
    module.exports = KAICookieHelper;
}
