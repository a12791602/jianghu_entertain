<?php

namespace App\Finance\Pay\Core;

/**
 * 所有支付类的契约.
 *
 * Interface Payment
 * @package App\Finance\Pay\Core
 */
interface Payment
{
    /**
     * 发起支付.
     *
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function recharge(): array;

    /**
     * 校验返回参数.
     *
     * @param array $data Data.
     * @return mixed[]
     * @throws \Exception Exception.
     */
    public function verify(array $data): array;
}
