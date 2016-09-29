<?php

namespace App\Providers;
use App\Observers\GradoObserver;
use Illuminate\Support\ServiceProvider;
use App\Grado;
use App\User;
use App\Evaluacione;
use App\Pregunta;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Grado::observe(GradoObserver::class);
        User::observe(GradoObserver::class);
        Evaluacione::observe(GradoObserver::class);
        Pregunta::observe(GradoObserver::class);
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
