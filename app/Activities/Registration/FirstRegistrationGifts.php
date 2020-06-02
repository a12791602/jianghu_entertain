<?php


namespace App\Registration;

use App\Game\BaseActivity;

/**
 * Class FirstRegistrationGifts
 * @package App\Lib\Activities\Registration
 */
class FirstRegistrationGifts extends BaseActivity
{
    /**
     * @return float|integer
     */
    public function draw()
    {
        $result = 0;
        if (isset($this->activity->model_class)) {
            $acConfigInstance = $this->activity->model_class;
            $acConfig         = $acConfigInstance->pluck('probability', 'item')->toArray();
            $result           = $this->getPrice($acConfigInstance, $acConfig);
        }
        return $result;
    }
}
