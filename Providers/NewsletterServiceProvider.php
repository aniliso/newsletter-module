<?php

namespace Modules\Newsletter\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Newsletter\Events\Handlers\RegisterNewsletterSidebar;

class NewsletterServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

//        $this->app['events']->listen(
//            BuildingSidebar::class,
//            $this->getSidebarClassForModule('Newsletter', RegisterNewsletterSidebar::class)
//        );

        $this->app->extend('asgard.ModulesList', function($app) {
            array_push($app, 'newsletter');
            return $app;
        });
    }

    public function boot()
    {
        $this->publishConfig('newsletter', 'config');
        $this->publishConfig('newsletter', 'permissions');
        $this->publishConfig('newsletter', 'settings');

        //$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
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

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Newsletter\Repositories\SubscriberRepository',
            function () {
                $repository = new \Modules\Newsletter\Repositories\Eloquent\EloquentSubscriberRepository(new \Modules\Newsletter\Entities\Subscriber());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Newsletter\Repositories\Cache\CacheSubscriberDecorator($repository);
            }
        );
// add bindings

    }
}
