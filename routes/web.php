<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketSearchController;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\AboutController as AdminAboutController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\RouteController as AdminRouteController;
use App\Http\Controllers\Admin\ScheduleController as AdminScheduleController;
use App\Http\Controllers\Admin\StationController as AdminStationController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/contact', [ProfileController::class, 'contact'])->name('contact');

// Legal Pages
Route::get('/syarat-ketentuan', function () {
    return view('terms');
})->name('terms');

Route::get('/kebijakan-privasi', function () {
    return view('privacy');
})->name('privacy');

// Ticket Search Routes
Route::get('/cari-tiket', [TicketSearchController::class, 'index'])->name('ticket.search');
Route::post('/cari-tiket', [TicketSearchController::class, 'search'])->name('ticket.search.post');

// AJAX Routes for Ticket Search
Route::get('/api/stations', [TicketSearchController::class, 'getStationsByCity'])->name('api.stations');
Route::get('/api/popular-routes', [TicketSearchController::class, 'getPopularRoutes'])->name('api.popular-routes');
Route::post('/api/check-availability', [TicketSearchController::class, 'checkAvailability'])->name('api.check-availability');
Route::get('/api/schedule/{id}', [TicketSearchController::class, 'getScheduleDetails'])->name('api.schedule.details');

// Chatbot API Routes
Route::post('/api/chatbot/chat', [ChatbotController::class, 'chat'])->name('api.chatbot.chat');
Route::get('/api/chatbot/history', [ChatbotController::class, 'getHistory'])->name('api.chatbot.history');
Route::post('/api/chatbot/clear', [ChatbotController::class, 'clearHistory'])->name('api.chatbot.clear');

// PDF Routes (Secure - View in browser)
Route::get('/panduan/{type}', [ChatbotController::class, 'viewPanduan'])->name('view.panduan');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Authentication routes (not protected by middleware)
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware(['auth', 'admin'])->group(function () {
        // Dashboard
        Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard.main');

        // About Management
        Route::resource('about', AdminAboutController::class);

        // News Management
        Route::resource('news', AdminNewsController::class);

        // Profile Management
        Route::resource('profiles', AdminProfileController::class);

        // Service Management
        Route::resource('services', AdminServiceController::class);

        // Station Management
        Route::resource('stations', AdminStationController::class);

        // Route Management
        Route::resource('routes', AdminRouteController::class);

        // Schedule Management
        Route::resource('schedules', AdminScheduleController::class);
    });
});
