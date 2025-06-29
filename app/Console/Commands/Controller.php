<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;

class Controller extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'module:make-controller {name} {module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Controller Module';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $module = $this->argument('module');
        $this->info('success');
        if(!File::exists(base_path('modules/'.$module))) {
            $this->error('Modules not exists!');
        }

        //1.Tạo folder SRC
        $srcFolder = base_path('modules/' . $module . '/src');
        if (File::exists($srcFolder)) {

            //2. Tạo folder http
            $httpFolder = base_path('modules/' . $module . '/src/Http');
            if (File::exists($httpFolder)) {
                // File::makeDirectory($httpFolder, 0755, true, true);

                //3. tạo Controllers modules
                $controllersFolder = base_path('modules/' . $module . '/src/Http/Controllers');
                if (File::exists($controllersFolder)) {
                    $controllerFile = app_path('Console/Commands/Templates/Controller.txt');
                    $controllerContent = File::get($controllerFile);
                    $controllerContent = str_replace('{module}', $module, $controllerContent);
                    $controllerContent = str_replace('{name}', $name, $controllerContent);

                    if (!File::exists($controllersFolder . '/' . $name . '.php')) {
                        File::put($controllersFolder . '/' . $name . '.php', $controllerContent);

                        return $this->info('Controller created successfully!');
                    } else {
                        return $this->error('Controller already exists!');
                    }

                }
            }
        }
        
        return $this->error('Base Folder Module not exists');
    }
}
