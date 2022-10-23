<?php

namespace App\Providers;

use App\Http\Kernel;
use Carbon\CarbonInterval;
use Illuminate\Database\Connection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Выбрасывает исключение если N+1
        Model::shouldBeStrict(!app()->isProduction());

        // Уведомление о слишком долгом подключении к БД или долгом выполнении SQL запроса
        if (app()->isProduction()) {
            DB::listen(static function($query) {

                if ($query->time > 500) {
                    logger()
                        ->channel('telegram')
                        ->debug('Слишком долгий запрос: ' . $query->sql, $query->bindings);
                }
            });
        }

        // Уведомление о слишком долгом выполнении запроса к сайту
        app(Kernel::class)->whenRequestLifecycleIsLongerThan(
            CarbonInterval::seconds(4),
            static function () {
                logger()
                    ->channel('telegram')
                    ->debug('whenRequestLifecycleIsLongerThan: ' . request()->url());
            }
        );
    }
}
