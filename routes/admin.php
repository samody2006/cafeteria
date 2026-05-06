<?php

            use App\Http\Controllers\Admin\AdminRecipeController;
use App\Http\Controllers\Admin\ContactInfoController;
use App\Http\Controllers\Admin\ContactMessageAdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', [AdminAuthenticatedSessionController::class, 'create'])
            ->name('admin.login');
        Route::post('login', [AdminAuthenticatedSessionController::class, 'store']);
    });

    Route::middleware(['auth', 'verified', 'role:admin|super-admin'])->group(function () {
        Route::get('/dashboard', DashboardController::class)->name('admin.dashboard');

        Route::name('admin.')->group(function () {
            Route::patch('recipes/{recipe}/toggle-publish', [AdminRecipeController::class, 'togglePublish'])->name('recipes.toggle-publish');
            Route::resource('recipes', AdminRecipeController::class)->except(['show']);
            Route::get('contact', [ContactInfoController::class, 'edit'])->name('contact.edit');
            Route::put('contact', [ContactInfoController::class, 'update'])->name('contact.update');
            Route::get('contact/messages', [ContactMessageAdminController::class, 'index'])->name('contact.messages.index');
            Route::get('contact/messages/{message}', [ContactMessageAdminController::class, 'show'])->name('contact.messages.show');
            Route::delete('contact/messages/{message}', [ContactMessageAdminController::class, 'destroy'])->name('contact.messages.destroy');
        });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

        Route::post('logout', [AdminAuthenticatedSessionController::class, 'destroy'])
            ->name('admin.logout');
    });
});
