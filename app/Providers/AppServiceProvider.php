<?php

namespace App\Providers;

use App\Observers\WidgetObserver;
use IbrahimBougaoua\Filawidget\Models\Widget;
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
        Widget::observe(WidgetObserver::class);
    }
}
