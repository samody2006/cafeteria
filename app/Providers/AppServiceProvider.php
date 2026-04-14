<?php

namespace App\Providers;

use App\Models\ContactMessage;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.admin-layout', function ($view) {
            $unread = ContactMessage::whereNull('read_at')->count();
            $recent = ContactMessage::latest()->take(5)->get();
            $view->with('unreadMessagesCount', $unread)
                 ->with('recentMessages', $recent);
        });
    }
}
