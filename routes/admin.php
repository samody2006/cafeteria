<?php

            use App\Http\Controllers\Admin\AdminRecipeController;
            use App\Http\Controllers\Admin\ContactInfoController;
            use App\Http\Controllers\Admin\ContactMessageAdminController;
            use App\Http\Controllers\Admin\DashboardController;
            use App\Http\Controllers\ProfileController;
            use Illuminate\Support\Facades\Route;

            Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->group(function () {
                Route::get('/dashboard', DashboardController::class)->name('dashboard');

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
            });
