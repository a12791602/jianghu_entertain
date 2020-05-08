<?php

namespace App\Console\Commands;

use App\JHHYLibs\GameCommons;
use App\Models\Game\GameVendor;
use Illuminate\Console\Command;

/**
 * 拉取三方游戏记录
 */
class PullGamesLog extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'gamelog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '拉取三方游戏记录';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $gameVendors = GameVendor::where('status', GameVendor::STATUS_OPEN)->get();
        foreach ($gameVendors as $vendor) {
            if ($vendor->sign === 'IM') {
                continue;
            }
            $gameInstance = GameCommons::gameInit($vendor);
            $gameInstance->saveBetOrder();
        }
    }
}
