<?php

namespace App\Console\Commands\Admin;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateCRUD extends Command
{
    protected $signature = 'admin:generate:crud {model}';

    protected $description = 'Generate CRUD views for a given model in the admin folder';

    public function handle()
    {
        $model = $this->argument('model');
        $viewsPath = resource_path("views/admin/{$model}");

        // Verificar si el directorio de vistas ya existe
        if (File::exists($viewsPath)) {
            $this->error("Las vistas para el modelo {$model} ya existen en la carpeta admin.");
            return;
        }

        // Crear el directorio de vistas
        File::makeDirectory($viewsPath, 0755, true);

        // Crear vistas
        $this->createView('index.blade.php', $model);
        $this->createView('create.blade.php', $model);
        $this->createView('edit.blade.php', $model);
        $this->createView('show.blade.php', $model);

        $this->info("Vistas CRUD generadas para el modelo {$model} en la carpeta admin.");
    }

    private function createView($viewName, $model)
    {
        $stubPath = base_path("stubs/{$viewName}.stub");
        $viewContent = File::get($stubPath);

        // Personaliza la vista con el nombre del modelo
        $viewContent = str_replace('{{modelName}}', $model, $viewContent);

        // Guarda la vista en el directorio correspondiente
        File::put(resource_path("views/admin/{$model}/{$viewName}"), $viewContent);
    }
}
