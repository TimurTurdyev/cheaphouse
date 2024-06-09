<?php

namespace App\Providers;

use App\Models\SettingEloquentStorage;
use Illuminate\Support\ServiceProvider;

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
        if (!$this->app->runningInConsole()) {
            $globalSetting = (new SettingEloquentStorage())->group('global');
            \Illuminate\Support\Facades\View::share('globalSetting', $globalSetting);
        }
    }
}
