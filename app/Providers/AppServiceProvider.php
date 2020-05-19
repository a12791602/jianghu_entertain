<?php

namespace App\Providers;

use App\Game\GameIF;
use App\Models\Game\GameSubType;
use App\Models\Game\GameType;
use App\Models\User\FrontendUser;
use App\Observers\FrontendUserObserver;
use App\Observers\GameTypeChildObserver;
use App\Observers\GameTypeObserver;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;

/**
 * Class AppServiceProvider
 *
 * @package App\Providers
 */
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        // Redis 0 database.
        $this->app->singleton(
            'redis_user_unique_id',
            static function () {
                return Redis::connection();
            },
        );
        $gameClass = Config::get('games_classes');
        if (empty($gameClass)) {
            return;
        }
        $gameClass = Arr::flatten($gameClass);
        if (empty($gameClass)) {
            return;
        }
        $this->app->tag($gameClass, GameIF::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        /**
         * Usage: Model::whereLike('name', ['mike', 'joe'])->get();
         * Relationships: Model::whereLike('message.type', ['text', 'sms'])->get();
         */
        FrontendUser::observe(FrontendUserObserver::class);
        GameType::observe(GameTypeObserver::class);
        GameSubType::observe(GameTypeChildObserver::class);
        if (env('APP_DEBUG') !== true) {
            return;
        }
        $this->_loggingDBQuery();
    }

    /**
     * logging DB qery
     * @return void
     */
    private function _loggingDBQuery(): void
    {
        DB::listen(
            function (QueryExecuted $query): void {
                $sqlWithPlaceholders = str_replace(['%', '?'], ['%%', '%s'], $query->sql);

                $bindings      = $query->connection->prepareBindings($query->bindings);
                $pdoConnection = $query->connection->getPdo();
                $realSql       = vsprintf(
                    $sqlWithPlaceholders,
                    array_map(
                        [
                         $pdoConnection,
                         'quote',
                        ],
                        $bindings,
                    ),
                );
                $duration      = $this->_formatDuration($query->time / 1000);
                $logInfo       = sprintf(
                    '[%s] %s | %s: %s',
                    $duration,
                    $realSql,
                    request()->method(),
                    request()->getRequestUri(),
                );
                Log::channel('query')->debug($logInfo);
            },
        );
    }
    /**
     * Format duration.
     *
     * @param float $seconds Seconds.
     *
     * @return string
     */
    private function _formatDuration(float $seconds): string
    {
        if ($seconds < 0.001) {
            return round($seconds * 1000000) . 'μs';
        }

        if ($seconds < 1) {
            return round($seconds * 1000, 2) . 'ms';
        }
        return round($seconds, 2) . 's';
    }
}
