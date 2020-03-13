<?php

namespace App\Game;

use App\Models\Game\GameVendor;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Log;

/**
 * Class Base
 * @package App\Game\Core
 */
abstract class BaseGame implements GameIF
{

    /**
     * @var GameVendor
     */
    protected $gameVendor;

    /**
     * @var \App\Models\Game\Game
     */
    protected $gameItem;

    /**
     * @var \App\Http\SingleActions\MainAction
     */
    protected $sysObj;

    /**
     * 赋值.
     * @param GameVendor $vendor GameVendor.
     * @return void
     */
    public function setVendor(GameVendor $vendor): void
    {
        $this->gameVendor = $vendor;
    }

    /**
     * @param Response $response Response of Url.
     * @return void
     */
    protected function rspLog(Response $response): void
    {
        $retLog = [
                   'ok'          => $response->ok(),
                   'successful'  => $response->successful(),
                   'status'      => $response->status(),
                   'headers'     => $response->headers(),
                   'body'        => $response->body(),
                   'JsonBody'    => $response->json(),
                   'serverError' => $response->serverError(),
                   'clientError' => $response->clientError(),
                  ];
        Log::channel('game')->info('返回数据', $retLog);
    }
}
