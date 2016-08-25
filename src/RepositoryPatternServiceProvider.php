<?php

namespace DetaTech\RepositoryPattern;

use Illuminate\Support\ServiceProvider;

class RepositoryPatternServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish the default configuration file so that the user has full 
        // flexibility to change the default configs as per their convenience
        $this->publishes([
            __DIR__ . '/config/repository_pattern.php' => config_path('repository_pattern.php')
        ], 'repository_pattern');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // Get the package's config file
        $this->mergeConfigFrom(__DIR__ . '/config/repository_pattern.php', 'repository_pattern');

        $this->commands([
            CreateRepositoryPattern::class
        ]);
    }
}
