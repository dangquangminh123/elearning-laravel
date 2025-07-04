<?php
namespace Modules;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\src\Commands\TestCommand;
use Modules\User\src\Http\Middlewares\DemoMiddleware;
use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\MongoUserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Video\src\Repositories\VideoRepository;
use Modules\Video\src\Repositories\VideoRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepository;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Students\src\Repositories\StudentsRepository;
use Modules\Students\src\Repositories\StudentsRepositoryInterface;
use Modules\Home\src\Repositories\HomeRepository;
use Modules\Home\src\Repositories\HomeRepositoryInterface;
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
        Paginator::useBootstrapFive();

    }
    public function bindingRepository() {
        // User repository
        $this->app->singleton(
            UserRepositoryInterface::class,
            UserRepository::class,
        );

        // Categories Respository
        $this->app->singleton(
            CategoriesRepositoryInterface::class,
            CategoriesRepository::class,
        );

        // Teacher Respository
        $this->app->singleton(
            TeacherRepositoryInterface::class,
            TeacherRepository::class,
        );

        //Courses Respository
        $this->app->singleton(
            CoursesRepositoryInterface::class,
            CoursesRepository::class,
        );

        //Video Respository
        $this->app->singleton(
            VideoRepositoryInterface::class,
            VideoRepository::class,
        );

        //Document Respository
        $this->app->singleton(
            DocumentRepositoryInterface::class,
            DocumentRepository::class,
        );

        //Document Respository
        $this->app->singleton(
            LessonsRepositoryInterface::class,
            LessonsRepository::class,
        );

        // Students Respository
        $this->app->singleton(
            StudentsRepositoryInterface::class,
            StudentsRepository::class,
        );

        // Home Repository
         $this->app->singleton(
            HomeRepositoryInterface::class,
            HomeRepository::class,
        );
        
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

       

        $this->bindingRepository();
        
    }

    private function getModules() {
        $directories = array_map('basename', File::directories(__DIR__));
        return $directories;
    }

    // Load modules
    private function registerModule($module) {
        $modulePath = __DIR__."/{$module}";

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'web'],function () use($modulePath) {
            if (File::exists($modulePath . '/routes/web.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/web.php');
            }
        });

        Route::group(['namespace' => "Modules\\{$module}\src\Http\Controllers", 'middleware' => 'api', 'prefix' => 'api'],function () use($modulePath) {
            if (File::exists($modulePath . '/routes/api.php')) {
                $this->loadRoutesFrom($modulePath . '/routes/api.php');
            }
        });

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