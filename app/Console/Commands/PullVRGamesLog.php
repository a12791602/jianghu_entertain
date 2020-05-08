<?php

namespace App\Console\Commands;

use App\JHHYLibs\GameCommons;
use App\Models\Game\GameProject;
use App\Models\Game\GameVendor;
use Illuminate\Console\Command;

/**
 * 拉取用户VR游戏记录
 */
class PullVRGamesLog extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'vrgame';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '拉取用户VR游戏记录';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle(): void
    {
        $curentVendorObj = GameVendor::where('sign', 'VR')->first();
        if ($curentVendorObj === null) {
            return;
        }
        $startTime = GameProject::where('pull_thier_status', GameProject::PULL_STATUS_NO)->min('created_at');
        if ($startTime === null) {
            return;
        }
        $gameInstance = GameCommons::gameInit($curentVendorObj);
        $gameInstance->pullGamesLog($startTime);
    }
}
