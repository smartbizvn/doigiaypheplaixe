<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

# Sample
use App\Repositories\Sample\SampleRepository;
use App\Repositories\Sample\SampleRepositoryInterface;

class RepositoryModuleServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        # Sample
        $this->app->bind(SampleRepositoryInterface::class, SampleRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
