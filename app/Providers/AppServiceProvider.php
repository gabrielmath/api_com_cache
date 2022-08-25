<?php

namespace App\Providers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Module;
use App\Observers\CourseObserver;
use App\Observers\LessonObserver;
use App\Observers\ModuleObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
//            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
//            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Course::observe(CourseObserver::class);
        Module::observe(ModuleObserver::class);
        Lesson::observe(LessonObserver::class);
    }
}
