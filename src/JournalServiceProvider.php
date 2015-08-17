<?php

namespace Molovo\Journal;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class JournalServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // use this if your package has views
        $this->loadViewsFrom(realpath(__DIR__.'/resources/views'), 'journal');

        // use this if your package has routes
        $this->setupRoutes($this->app->router);

        // use this if your package needs a config file
        $this->publishes([
            __DIR__.'/config/config.php' => config_path('journal.php'),
        ]);

        // use the vendor configuration file as fallback
        $this->mergeConfigFrom(
            __DIR__.'/config/config.php', 'journal'
        );

        $this->publishes( [
            __DIR__.'/resources/assets/dist' => public_path( 'vendor/molovo/journal' )
        ], 'public' );
    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router  $router
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        $router->group( [ 'namespace' => 'Molovo\Journal\Http\Controllers' ], function( $router )
        {
            require __DIR__.'/Http/routes.php';
        } );
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerJournal();

        // use this if your package has a config file
        config([
                'config/journal.php',
        ]);
    }

    private function registerJournal()
    {
        $this->app->bind('journal',function($app){
            return new Journal($app);
        });
    }
}