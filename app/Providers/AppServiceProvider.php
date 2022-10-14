<?php

namespace App\Providers;

use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Выбрасывает исключение если N+1
        Model::preventLazyLoading(! app()->isProduction());

        // Выбрасывает исключение если обращение у модели к свойству которое есть в миграции, но не задано в $fillable
        Model::preventSilentlyDiscardingAttributes(! app()->isProduction());

        DB::whenQueryingForLongerThan(500, function(Connection $connection) {
            // Todo 3rd lesson
        });

        // todo 3rd lesson
    }
}
