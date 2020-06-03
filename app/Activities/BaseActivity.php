<?php

namespace App\Activities;

use App\Models\Activity\ActivitiesDynLogs;
use App\Models\Activity\ActivitiesDynSystem;
use App\Models\User\FrontendUser;
use App\Models\User\FrontendUsersAccount;

/**
 * Class Base
 * @package App\Game\Core
 */
abstract class BaseActivity implements ActivitiesIF
{

    /**
     * @var ActivitiesDynSystem ActivitiesDynSystem Model.
     */
    protected $activity;

    /**
     * @var FrontendUser FrontendUser.
     */
    protected $user;

    /**
     * BaseActivity constructor.
     * @param ActivitiesDynSystem $activity ActivitiesDynSystem Model.
     */
    public function __construct(ActivitiesDynSystem $activity)
    {
        $this->activity = $activity;
    }

    /**
     * @param FrontendUser $user FronteneUser.
     * @return void
     */
    public function setRequirements(FrontendUser $user): void
    {
        $this->user = $user;
    }

    /**
     * @param object $acConfigInstance 获取对应游戏的奖品拥有的model.
     * @param array  $acConfig         奖品配置数组.
     * @return mixed
     */
    protected function drawItem(object $acConfigInstance, array $acConfig)
    {
        $item = $this->getItemByProb($acConfig);
        return $acConfigInstance->where('item', $item)->first();
    }

    /**
     * Create the formula for probability with min max of possible outcomes
     * @param array $itemProbConfig ProbConfig [1=>60,2=>30,3=>10].
     * @return array<int|string, array<string, mixed>>
     */
    protected function generateProbFormula(array $itemProbConfig): array
    {
        $probMin      = 0;
        $probMax      = 0;
        $itemWithProb = [];
        foreach ($itemProbConfig as $configKey => $configValue) {
            $probMax                  = empty($probMax) ? $configValue : $probMin + $configValue;//first min + first max;
            $itemWithProb[$configKey] = [
                                         'min' => $probMin,
                                         'max' => $probMax,
                                        ];
            $probMin                  = $probMax;
        }
        return $itemWithProb;
    }

    /**
     * Draw Items from its Probability Config
     * @param array   $itemWithProb       Item with Probability.
     * @param integer $possible_out_comes Possible out Comes.
     * @param integer $loop               Loop times.
     * @return integer|string
     */
    protected function drawing(array $itemWithProb, int $possible_out_comes = 100, int $loop = 1)
    {
        $lastItem = 0;
        for ($i = 0; $i < $loop; $i++) {
            $rndItem = random_int(1, $possible_out_comes);
            foreach ($itemWithProb as $itemKey => $probabilityValue) {
                if ($rndItem <= $probabilityValue['min'] || $rndItem > $probabilityValue['max']) {
                    continue;
                }
                $lastItem = $itemKey;
            }
        }
        return $lastItem;
    }

    /**
     * 拿概率获取随机
     * @param array $proArr ProbConfig [1=>60,2=>30,3=>10].
     * @return integer|string
     */
    protected function getItemByProb(array $proArr)
    {
        $arr_formula = $this->generateProbFormula($proArr);
        return $this->drawing($arr_formula, (int) array_sum($proArr));
    }

    /**
     * @param array $params Param [user_id, amount,activity_dyn_id,item,times].
     * @return mixed
     * @throws \RuntimeException Exception.
     */
    protected function sendGift(array $params)
    {
        $userAccount = $this->user->account;
        $bankCard    = $this->user->bankCard()->exists();
        if (!$bankCard) {
            throw new \RuntimeException('100907');
        }
        if (! $userAccount instanceof FrontendUsersAccount) {
            throw new \RuntimeException('100505');
        }
        $userAccount->operateAccount(
            'diy_gift',
            $params,
        );
        return ActivitiesDynLogs::create($params);
    }
}
