<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // View Composer untuk Sidebar Admin (Jumlah Booking Pending)
        view()->composer('layouts.sidebar', function ($view) {
            if (auth()->check() && auth()->user()->role === 'admin') {
                $pendingCount = \App\Models\Booking::where('status', 'pending')->count();
                $view->with('pendingCount', $pendingCount);
            }
        });
    }
}
