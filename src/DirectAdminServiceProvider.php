<?php

namespace cuteminded\DirectadminLaravel;

use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class DirectAdminServiceProvider extends IlluminateServiceProvider
{
    public function register()
    {
        $this->mergeConfig();
    }

    public function boot()
    {
        $this->publishConfig();
    }

    private function mergeConfig()
    {
        $path = $this->getConfigPath();
        $this->mergeConfigFrom($path, 'Directadmin');
    }

    private function publishConfig()
    {
        $path = $this->getConfigPath();
        $this->publishes([$path => config_path('Directadmin.php')], 'config');
    }

    private function getConfigPath()
    {
        return __DIR__ . '/../config/Directadmin.php';
    }
}
