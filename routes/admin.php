<?php

use App\Http\Controllers\Admin;

foreach ([
    'services' => Admin\ServiceController::class,
    'skills' => Admin\SkillController::class,
    'responsibilities' => Admin\ResponsibilityController::class,
    'portfolio-categories' => Admin\PortfolioCategoryController::class,
    'projects' => Admin\ProjectController::class,
    'team-members' => Admin\TeamMemberController::class,
    'certificates' => Admin\CertificateController::class,
    'testimonials' => Admin\TestimonialController::class,
    'faqs' => Admin\FaqController::class,
    'stats' => Admin\StatController::class,
    'posts' => Admin\PostController::class,
    'pages' => Admin\PageController::class,
    'pricing-packages' => Admin\PricingPackageController::class,
    'calculator-items' => Admin\CalculatorItemController::class,
] as $uri => $controller) {
    Route::resource($uri, $controller)->except(['show']);
}

Route::post('settings', [Admin\SettingsController::class, 'update'])->name('settings.update');
Route::get('leads', [Admin\LeadController::class, 'index'])->name('leads.index');
Route::patch('leads/{lead}', [Admin\LeadController::class, 'update'])->name('leads.update');
Route::get('leads/export', [Admin\LeadController::class, 'export'])->name('leads.export');
Route::get('visitors', [Admin\VisitorController::class, 'index'])->name('visitors.index');
Route::delete('visitors/{visitor}', [Admin\VisitorController::class, 'destroy'])->name('visitors.destroy');
Route::get('users', [Admin\UserController::class, 'index'])->name('users.index');
Route::patch('users/{user}', [Admin\UserController::class, 'update'])->name('users.update');
Route::delete('users/{user}', [Admin\UserController::class, 'destroy'])->name('users.destroy');
Route::resource('tasks', Admin\TaskController::class)->except(['show', 'edit', 'create']);
Route::patch('tasks/{task}/status', [Admin\TaskController::class, 'status'])->name('tasks.status');
Route::resource('client-projects', Admin\ClientProjectController::class)->except(['show', 'edit', 'create']);
Route::resource('invoices', Admin\InvoiceController::class)->except(['show', 'edit', 'create']);
Route::get('invoices/{invoice}/voucher', [Admin\InvoiceController::class, 'voucher'])->name('invoices.voucher');
Route::get('payments', [Admin\PaymentController::class, 'index'])->name('payments.index');
Route::patch('payments/{payment}/approve', [Admin\PaymentController::class, 'approve'])->name('payments.approve');
Route::patch('payments/{payment}/reject', [Admin\PaymentController::class, 'reject'])->name('payments.reject');
Route::get('chats', [Admin\ChatController::class, 'index'])->name('chats.index');
Route::get('chats/{conversation}', [Admin\ChatController::class, 'show'])->name('chats.show');
Route::post('chats/{conversation}/messages', [Admin\ChatController::class, 'reply'])->name('chats.reply');
Route::get('settings', [Admin\SettingsController::class, 'edit'])->name('settings.edit');
Route::delete('project-images/{image}', [Admin\ProjectController::class, 'destroyImage'])->name('project-images.destroy');
