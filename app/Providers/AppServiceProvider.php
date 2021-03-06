<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Laravel\Dusk\DuskServiceProvider;
use League\Fractal\Manager;
use League\Fractal\Serializer\JsonApiSerializer;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            Manager::class,
            function () {
                $manager = new Manager;
                $manager->setSerializer(new JsonApiSerializer);
                return $manager;
            }
        );

        if (\in_array($this->app->environment(), ['local', 'testing'])) {
            $this->app->register(DuskServiceProvider::class);
        }
    }
}
