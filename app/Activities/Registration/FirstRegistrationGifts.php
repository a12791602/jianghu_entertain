<?php


namespace App\Activities\Registration;

use App\Activities\BaseActivity;
use App\Models\Activity\ActivitiesDynLogs;
use Illuminate\Support\Facades\DB;

/**
 * Class FirstRegistrationGifts
 * @package App\Lib\Activities\Registration
 */
class FirstRegistrationGifts extends BaseActivity
{

    /**
     * @return array<string,string>|integer|string
     * @throws \Exception Exception.
     */
    public function draw()
    {
        $activity = $this->activity;
        if (!isset($activity->model_class)) {
            throw new \Exception('500003');
        }
        $acConfigInstance = $this->activity->model_class;
        $acConfig         = $acConfigInstance->pluck('probability', 'item')->toArray();
        $itemEloq         = $this->drawItem($acConfigInstance, $acConfig);
        $params           = [
                             'user_id'         => $this->user->id,
                             'amount'          => $itemEloq->amount,
                             'activity_dyn_id' => $this->activity->id,
                             'item'            => $itemEloq->item,
                            ];
        $count            = $this->count();
        if ($count > 0) {
            throw new \Exception('500004');
        }
        DB::beginTransaction();
        $result = $this->sendGift($params);
        if (!$result instanceof ActivitiesDynLogs) {
            DB::rollback();
            throw new \Exception('500001');
        }
        DB::commit();
        return $result->only(['amount', 'item']);
    }

    /**
     * 获取领取次数
     * @return mixed
     */
    protected function count()
    {
        return ActivitiesDynLogs::where(
            [
             'user_id'         => $this->user->id,
             'activity_dyn_id' => $this->activity->id,
            ],
            )->count();
    }
}
