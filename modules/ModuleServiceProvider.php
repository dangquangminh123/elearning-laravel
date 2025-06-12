<?php
namespace Modules;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\src\Commands\TestCommand;
use Modules\User\src\Http\Middlewares\DemoMiddleware;
use Modules\User\src\Repositories\UserRepository;

// use File;

class ModuleServiceProvider extends ServiceProvider
{
    private $middlewares = [
       
    ];

    private $commands = [
        
    ];

    public function boot(){
        $modules = $this->getModules();
        if(!empty($modules)) {
            foreach($modules as $module) {
                $this->registerModule($module);
            }
        }
    }

    public function register() {
        $directories = array_map('basename', File::directories(__DIR__));
        if(!empty($modules)) {
            foreach($modules as $module) {
                $this->registerConfig($module);
            }
        }

        $this->registerMiddlewares();

        // Khai báo commands
        $this->commands($this->commands);

        // $this->app->singleton();
    }

    private function getModules() {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }

    // Load modules
    private function registerModule($module) {
        $modulePath = __DIR__."/{$module}";

        if (File::exists($modulePath . '/routes/routes.php')) {
            $this->loadRoutesFrom($modulePath . '/routes/routes.php');
        }

         //Khai báo migrations
        if (File::exists($modulePath . '/migrations')) {
            $this->loadMigrationsFrom($modulePath . '/migrations');
        }

        // Khai báo languages
        if (File::exists($modulePath . "/resources/lang")) {
            // Đa ngôn ngữ theo file php
            $this->loadTranslationsFrom($modulePath . "/resources/lang", strtolower($module));
            // Đa ngôn ngữ theo file json
            $this->loadJSONTranslationsFrom($modulePath . '/resources/lang');
        }

        // Khai báo views
        if (File::exists($modulePath . "/resources/views")) {
            $this->loadViewsFrom($modulePath . "/resources/views", strtolower($module));
        }

        // Khai báo helpers
        if (File::exists($modulePath . "/helpers")) {
            $helperList = File::allFiles($modulePath . "/helpers");
            if(!empty($helperList)) {
                foreach ($helperList as $helper) {
                    $file = $helper->getPathName();
                    require $file;
                }
            }
        }


    }

    // Load Config
    private function registerConfig($module){
        $configPath = __DIR__.'/'.$module.'/configs';
        if(File::exists($configPath)) {
            $configFiles = array_map('basename', File::allFiles($configPath));
            foreach($configFiles as $config){
                $alias = basename($config, '.php');
                $this->mergeConfigFrom($configPath.'/'.$config, $alias);
            }
        }
    }

    //Load middleware
    private function registerMiddlewares() {
        if(!empty($this->middlewares)) {
            foreach($this->middlewares as $key => $middleware) {
                $this->app['router']->pushMiddlewareToGroup($key, $middleware);
            }
        }
    }

}