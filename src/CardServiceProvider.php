<?php

namespace DigitalCreative\NovaApexChart;

use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Events\ServingNova;
use Laravel\Nova\Nova;

class CardServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-apex-chart', __DIR__ . '/../dist/js/nova-apex-chart.js');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

}
