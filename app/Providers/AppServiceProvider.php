<?php

namespace App\Providers;

use App\Game\GameIF;
use App\Models\Game\GameSubType;
use App\Models\Game\GameType;
use App\Models\User\FrontendUser;
use App\Observers\FrontendUserObserver;
use App\Observers\GameTypeChildObserver;
use App\Observers\GameTypeObserver;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Config;
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
    }
}
