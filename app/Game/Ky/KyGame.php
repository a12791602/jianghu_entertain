<?php

namespace App\Game\Ky;

use App\Game\Core\Base;
use App\Models\Game\Game;

/**
 * Class KyGame
 * @package App\Game\Ky
 */
class KyGame extends Base
{

    /**
     * 进入游戏.
     *
     * @param Game $gameObj GameObj.
     * @return KyGame[]
     */
    public function game(Game $gameObj): array
    {
        $result = $gameObj->toArray();
        return $result;
        // TODO: Implement game() method.
    }

    /**
     * 上分.
     *
     * @return boolean
     */
    public function upScore(): bool
    {
        // TODO: Implement upScore() method.
        return false;
    }

    /**
     * 下分.
     *
     * @return boolean
     */
    public function downScore(): bool
    {
        // TODO: Implement downScore() method.
        return false;
    }

    /**
     * 检查用户余额.
     *
     * @return float
     */
    public function checkBalance(): float
    {
        // TODO: Implement checkBalance() method.
        return 0.00;
    }

    /**
     * 检查用户上下分订单是否成功.
     *
     * @return boolean
     */
    public function checkOrder(): bool
    {
        // TODO: Implement checkOrder() method.
        return false;
    }

    /**
     * 保存用户在第三方平台的打码注单.
     *
     * @return void
     */
    public function saveBetOrder(): void
    {
        // TODO: Implement saveBetOrder() method.
    }
}
