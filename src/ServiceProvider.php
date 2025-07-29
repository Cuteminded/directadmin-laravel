<?php

namespace cuteminded\DirectadminLaravel;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ServiceProvider extends IlluminateServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @throws \Exception
     * @return void
     */
    public function register(): void
    {
        $configPath = __DIR__ . '/../config/Directadmin.php';
        $this->mergeConfigFrom($configPath, 'Directadmin');
    }
}
