<?php

namespace ErpNET\Migrates\Providers;

use Illuminate\Support\ServiceProvider;

class ErpnetMigratesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $projectRootDir = __DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR;
        $migrationsDir = $projectRootDir."database".DIRECTORY_SEPARATOR."migrations";
//        $routesDir = $projectRootDir."routes".DIRECTORY_SEPARATOR;

        $app = $this->app;

        //Publish Config
//        $configPath = __DIR__ . '/../config/debugbar.php';
//        $this->publishes([$configPath => $this->getConfigPath()], 'config');

        $this->publishes([ $migrationsDir => database_path("migrations") ], 'migrations');

        //Bind Interfaces
//        $app->bind(PartnerRepository::class, PartnerRepositoryEloquent::class);
//        $app->bind(OrderRepository::class, OrderRepositoryEloquent::class);
//        $app->bind(MandanteRepository::class, MandanteRepositoryEloquent::class);

        //Routing
//        include $routesDir."api.php";
//        include $routesDir."web.php";

    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
//        $this->app->register(\Dingo\Api\Provider\LaravelServiceProvider::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [];
    }
}