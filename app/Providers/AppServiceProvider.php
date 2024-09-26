<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth; // Auth ফ্যাসাডও ইম্পোর্ট করা উচিত

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
         // Authentication Successful হলে রিডাইরেকশন
        $this->registerRedirects();
    }

    protected function registerRedirects()
    {
        \Illuminate\Support\Facades\Route::middleware('auth')->group(function () {
            Route::get('/redirect', function () {
                if (Auth::user()->role == 'admin') {
                    return redirect()->route('admin.dashboard');
                } else {
                    return redirect()->route('dashboard');
                }
            });
        });
    }
}
