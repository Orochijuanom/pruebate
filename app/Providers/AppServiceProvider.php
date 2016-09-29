<?php

namespace App\Providers;
use App\Observers\LogObserver;
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
        //Registrando los observadores
        Grado::observe(LogObserver::class);
        User::observe(LogObserver::class);
        Evaluacione::observe(LogObserver::class);
        Pregunta::observe(LogObserver::class);
        
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
