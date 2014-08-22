<?php namespace Lavalite\Page;

use Illuminate\Support\ServiceProvider;

class PageServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('lavalite/page');
        include __DIR__.'/../../routes.php';
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('page', function ($app) {
            return $this->app->make('Lavalite\Page\Page');
        });

        $this->app->bind(
            'Lavalite\\Page\\Interfaces\\PageInterface',
            'Lavalite\\Page\\Repositories\\Eloquent\\PageRepository'
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

}
