<?php

namespace App\Providers;

use App\Game\GameIF;
use App\Models\Game\GameType;
use App\Models\Game\GameTypeChild;
use App\Models\User\FrontendUser;
use App\Observers\FrontendUserObserver;
use App\Observers\GameTypeChildObserver;
use App\Observers\GameTypeObserver;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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
                $result = Redis::connection();
                return $result;
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
        Builder::macro(
            'whereLike',
            function ($attributes, $terms): object {
                $this->where(
                    static function ($query) use ($attributes, $terms): void {
                        foreach (Arr::wrap($attributes) as $attribute) {
                            // If it's a single item, wrap the value in an array e.g. $term = [$term];
                            foreach (Arr::wrap($terms) as $term) {
                                // When whereLike contains a relationship.value, search the relationship value
                                $query->when(
                                    Str::contains($attribute, '.'),
                                    static function ($query) use ($attribute, $term): void {
                                        [
                                         $relationName,
                                         $relationAttribute,
                                        ] = explode('.', $attribute);
                                        // Validating if the relationship exists on the current query
                                        $query->orWhereHas(
                                            $relationName,
                                            static function ($query) use ($relationAttribute, $term): void {
                                                $query->where($relationAttribute, 'LIKE', '%' . $term . '%');
                                            },
                                        );
                                    },
                                    // A fallback for when the string DOES not contain a relationship
                                    static function ($query) use ($attribute, $term): void {
                                        $query->orWhere($attribute, 'LIKE', '%' . $term . '%');
                                    },
                                );
                            }
                        }
                    },
                );
                // Return the $query, so you can call other methods like ->get(), ->first(), ->where(), etc
                return $this;
            },
        );
        FrontendUser::observe(FrontendUserObserver::class);
        GameType::observe(GameTypeObserver::class);
        GameTypeChild::observe(GameTypeChildObserver::class);
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

                Log::debug(
                    sprintf(
                        '[%s] %s | %s: %s',
                        $duration,
                        $realSql,
                        request()->method(),
                        request()->getRequestUri(),
                    ),
                );
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
            $result = round($seconds * 1000000) . 'μs';
            return $result;
        }

        if ($seconds < 1) {
            $result = round($seconds * 1000, 2) . 'ms';
            return $result;
        }
        $result = round($seconds, 2) . 's';
        return $result;
    }
}
