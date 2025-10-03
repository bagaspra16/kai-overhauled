<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketSearchController;
use App\Http\Controllers\ChatbotController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/news', [NewsController::class, 'index'])->name('news');
Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');
Route::get('/contact', [ProfileController::class, 'contact'])->name('contact');

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
