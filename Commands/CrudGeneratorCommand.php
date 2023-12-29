<?php

namespace Ismail\CrudGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class CrudGeneratorCommand extends Command {
    protected $signature = 'crud:generate';

    protected $description = 'Generate CRUD components';

    public function handle() {
        // Generate Controller
        Artisan::call('make:controller', [
            'name'       => 'CrudController',
            '--model'    => 'CrudModel',
            '--resource' => true,
        ]);

        // Generate Model
        Artisan::call('make:model', [
            'name'        => 'CrudModel',
            '--migration' => true,
        ]);

        // Generate Request
        Artisan::call('make:request', [
            'name' => 'CrudRequest',
        ]);

        // Generate Views
        $viewsPath = resource_path('views/crud');
        if (!file_exists($viewsPath)) {
            mkdir($viewsPath, 0755, true);
        }

        $this->generateViewFile('index');
        $this->generateViewFile('create');
        $this->generateViewFile('edit');

        // Run Migration
        Artisan::call('migrate');

        $this->info('CRUD components generated successfully.');
    }

    private function generateViewFile($viewName) {
        $stub = file_get_contents(__DIR__ . '/../Resources/views/' . $viewName . '.blade.php');
        file_put_contents(resource_path('views/crud/' . $viewName . '.blade.php'), $stub);
    }
}
