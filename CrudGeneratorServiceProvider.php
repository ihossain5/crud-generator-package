<?php

namespace Ismail\CrudGenerator;

use Illuminate\Support\ServiceProvider;

class CrudGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Ismail\CrudGenerator\Commands\CrudGeneratorCommand::class,
            ]);
        }
    }

    public function register()
    {
       
    }
}
