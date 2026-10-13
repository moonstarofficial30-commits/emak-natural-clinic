<?php

use Illuminate\Support\Facades\Route;

// Public controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\CareerController;
use App\Http\Controllers\LanguageController;

// Auth
use App\Http\Controllers\Auth\LoginController;

// Admin controllers
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\NewsController as AdminNewsController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\CareerController as AdminCareerController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\AppointmentController as AdminAppointmentController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ActivityLogController;

/*
|--------------------------------------------------------------------------
| PUBLIC WEBSITE ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
Route::get('/services/{service:slug}', [ServiceController::class, 'show'])->name('services.show');

Route::get('/doctors', [DoctorController::class, 'index'])->name('doctors.index');
Route::get('/doctors/{doctor}', [DoctorController::class, 'show'])->name('doctors.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/appointment', [AppointmentController::class, 'create'])->name('appointment.create');
Route::post('/appointment', [AppointmentController::class, 'store'])->name('appointment.store');

Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');

Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news:slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/faq', [FaqController::class, 'index'])->name('faq.index');
Route::get('/careers', [CareerController::class, 'index'])->name('careers.index');

// Language switcher — visitor picks language from the menu; remembered via
// session + cookie. See App\Http\Middleware\SetLocale.
Route::get('/lang/{locale}', [LanguageController::class, 'switch'])
    ->name('lang.switch')
    ->where('locale', 'en|sw|fr|zh');

/*
|--------------------------------------------------------------------------
| ADMIN / RECEPTIONIST AUTH
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    });

    Route::post('/logout', [LoginController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');
});

/*
|--------------------------------------------------------------------------
| ADMIN / RECEPTIONIST DASHBOARD (auth required)
|--------------------------------------------------------------------------
| force.password redirects a user with must_change_password=true straight
| to Settings until they update their default username/password.
*/

Route::prefix('admin')->name('admin.')->middleware(['auth', 'force.password'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Settings — available to both roles (own account); site settings inside are admin-gated in the view/controller.
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings/account', [SettingsController::class, 'updateAccount'])->name('settings.account');

    // Appointments & Contact Messages — available to both receptionist and admin.
    Route::get('/appointments', [AdminAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [AdminAppointmentController::class, 'show'])->name('appointments.show');
    Route::put('/appointments/{appointment}/status', [AdminAppointmentController::class, 'updateStatus'])->name('appointments.status');

    Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{message}', [ContactMessageController::class, 'show'])->name('messages.show');
    Route::delete('/messages/{message}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

    /*
    |----------------------------------------------------------------------
    | ADMIN-ONLY (role = admin) — content management, users, logs, site settings
    |----------------------------------------------------------------------
    */
    Route::middleware('admin')->group(function () {
        Route::put('/settings/site', [SettingsController::class, 'updateSite'])->name('settings.site');

        Route::resource('doctors', AdminDoctorController::class)->except(['show']);
        Route::resource('services', AdminServiceController::class)->except(['show']);
        Route::resource('news', AdminNewsController::class)->except(['show']);
        Route::resource('faqs', AdminFaqController::class)->except(['show']);
        Route::resource('careers', AdminCareerController::class)->except(['show']);
        Route::resource('users', AdminUserController::class)->except(['show']);

        Route::get('/gallery', [AdminGalleryController::class, 'index'])->name('gallery.index');
        Route::get('/gallery/create', [AdminGalleryController::class, 'create'])->name('gallery.create');
        Route::post('/gallery', [AdminGalleryController::class, 'store'])->name('gallery.store');
        Route::delete('/gallery/{gallery}', [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

        Route::get('/logs', [ActivityLogController::class, 'index'])->name('logs.index');
    });
});
