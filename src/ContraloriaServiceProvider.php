<?php
 
namespace MiguelGarces\ConsultaContraloria;
 
use Illuminate\Support\ServiceProvider;

use MiguelGarces\ConsultaContraloria\Consultas\ConsultaContraloriaByNit;
 
class ContraloriaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('ConsultaContraloriaByNit', function () {
            return new ConsultaContraloriaByNit();
        });
    }
 
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/contraloria.php' => config_path('contraloria.php'),
        ]);
    }
 
}