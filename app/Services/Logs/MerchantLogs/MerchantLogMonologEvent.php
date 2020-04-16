<?php

/**
 * Created by PhpStorm.
 * author: harris
 * Date: 3/27/19
 * Time: 10:37 AM
 */

namespace App\Services\Logs\MerchantLogs;

use Illuminate\Queue\SerializesModels;

/**
 * Class MerchantLogMonologEvent
 * @package App\Services\Logs\BackendLogs
 */
class MerchantLogMonologEvent
{
    use SerializesModels;

    /**
     * @var array
     */
    public $records;

    /**
     * @param array $records Records.
     */
    public function __construct(array $records)
    {
        $this->records = $records;
    }
}
