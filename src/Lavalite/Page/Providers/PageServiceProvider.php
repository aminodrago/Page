<?php

namespace Lavalite\Page\Providers;

use Lavalite\Page\Models\Page;
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
     */
    public function boot()
    {
        Page::saving(function ($model) {
            $model->upload($model);

        });

        Page::creating(function ($model) {
            $model->slug = !empty($model->slug) ? $model->slug : $model->getUniqueSlug($model->name);
        });

        $this->loadViewsFrom(__DIR__.'/../../../../resources/views', 'page');

        $this->loadTranslationsFrom(__DIR__.'/../../../../resources/lang', 'page');

        $this->publishResources();
        $this->publishMigrations();


        include __DIR__.'/../Http/routes.php';
    }

    /**
     * Register the service provider.
     */
    public function register()
    {
        $this->app->bind('page', function ($app) {
            return $this->app->make('Lavalite\Page\Page');
        });

        $this->app->bind(
            'Lavalite\\Page\\Interfaces\\PageRepositoryInterface',
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
        return array('page');
    }

    /**
     * Publish configuration file.
     */
    private function publishResources()
    {
        $this->publishes([__DIR__.'/../../../../config/config.php' => config_path('page.php')], 'config');
    }

    /**
     * Publish migration file.
     */
    private function publishMigrations()
    {
        $this->publishes([__DIR__.'/../../../../database/migrations/' => base_path('database/migrations')], 'migrations');
        $this->publishes([__DIR__.'/../../../../databases/seeds/' => base_path('database/seeds')], 'seeds');
    }

}
