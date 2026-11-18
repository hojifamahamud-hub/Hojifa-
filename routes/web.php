<?php

use App\Http\Controllers\Admin\AuthController as AdminAuth;
use App\Http\Controllers\Admin\DashboardController as AdminDashboard;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\Client\DashboardController as ClientDashboard;
use App\Http\Controllers\Client\PaymentController;
use App\Http\Controllers\Client\ProjectController as ClientProjectController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\RequirementController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\VisitorLeadController;
use App\Http\Middleware\EnsureAdmin;
use Illuminate\Support\Facades\Route;

Route::middleware('locale')->group(function () {
    Route::get('/', HomeController::class)->name('home');
    Route::get('/services', [PageController::class, 'services'])->name('services');
    Route::get('/about', AboutController::class)->name('about');
    Route::get('/contact', [ContactController::class, 'show'])->name('contact');
    Route::post('/contact', [ContactController::class, 'store'])->middleware('throttle:leads')->name('contact.store');
    Route::get('/request-custom-work', [RequirementController::class, 'show'])->name('requirement.show');
    Route::post('/request-custom-work', [RequirementController::class, 'store'])->middleware('throttle:leads')->name('requirement.store');
    Route::get('/portfolio/{categorySlug?}', [PortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/portfolio/show/{project:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::post('/visitors', VisitorLeadController::class)->middleware('throttle:leads')->name('visitors.store');
    Route::post('/chat', [ChatController::class, 'store'])->middleware('throttle:chat')->name('chat.store');
    Route::get('/lang/{locale}', LocaleController::class)->name('locale.switch');
    Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'show'])->name('login');
        Route::post('/login', [LoginController::class, 'store'])->name('login.store');
        Route::get('/register', [RegisterController::class, 'show'])->name('register');
        Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
        Route::get('/membership', [MembershipController::class, 'show'])->name('membership.show');
        Route::post('/membership', [MembershipController::class, 'store'])->middleware('throttle:leads')->name('membership.store');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

    Route::middleware(['auth', 'client'])->prefix('dashboard')->group(function () {
        Route::get('/', [ClientDashboard::class, 'index'])->name('client.dashboard');
        Route::post('/projects', [ClientProjectController::class, 'store'])->name('client.projects.store');
        Route::get('/invoices/{invoice}', [ClientDashboard::class, 'invoice'])->name('client.invoice.show');
        Route::get('/invoices/{invoice}/pay', [PaymentController::class, 'show'])->name('client.pay.show');
        Route::post('/invoices/{invoice}/pay', [PaymentController::class, 'store'])->name('client.pay.store');
        Route::get('/vouchers/{payment}', [PaymentController::class, 'voucher'])->name('client.voucher.show');
    });

    Route::middleware(['auth', 'member'])->prefix('team')->group(function () {
        Route::get('/', \App\Http\Controllers\Team\DashboardController::class)->name('team.dashboard');
        Route::patch('/tasks/{task}', \App\Http\Controllers\Team\TaskController::class)->name('team.tasks.update');
    });

    Route::middleware('guest')->group(function () {
        Route::get('/admin/login', [AdminAuth::class, 'show'])->name('admin.login');
        Route::post('/admin/login', [AdminAuth::class, 'store'])->name('admin.login.store');
    });

    Route::middleware(['auth', EnsureAdmin::class])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [AdminDashboard::class, 'index'])->name('dashboard');
        Route::post('/logout', [AdminAuth::class, 'logout'])->name('logout');
        require __DIR__ . '/admin.php';
    });
});
