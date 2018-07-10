<?php

namespace ErpNET\Migrates\Providers;

use Illuminate\Support\ServiceProvider;

class ErpnetMigratesServiceProvider extends ServiceProvider
{
    protected $commands = [
        \ErpNET\Migrates\Console\Commands\Install::class,
    ];

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
        $configPath = $projectRootDir . 'config/erpnetMigrates.php';
        $this->mergeConfigFrom($configPath, 'erpnetMigrates');
        $this->publishes([
            $projectRootDir.'config/erpnetMigrates.php' => config_path('erpnetMigrates.php'),
        ], 'erpnetMigratesConfig');

        $this->publishes([ $migrationsDir => database_path("migrations") ], 'erpnetMigratesMigrations');

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

        // register the artisan commands
        $this->commands($this->commands);
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
