<?php

namespace App\ModelFilters\Email;

use EloquentFilter\ModelFilter;

/**
 * Class SystemEmailFilter
 *
 * @package App\ModelFilters\Email
 */
class SystemEmailFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * 按是否发送.
     *
     * @param integer $is_send IsSend.
     * @return SystemEmailFilter
     */
    public function isSend(int $is_send): SystemEmailFilter
    {
        $object = $this->where('is_send', $is_send);
        return $object;
    }

    /**
     * 按标题.
     *
     * @param string $title Title.
     * @return SystemEmailFilter
     */
    public function title(string $title): SystemEmailFilter
    {
        $object = $this->where('title', $title);
        return $object;
    }

    /**
     * 按收件人.
     *
     * @param string $name Name.
     * @return SystemEmailFilter
     */
    public function name(string $name): SystemEmailFilter
    {
        $object = $this->where('receivers', 'like', '%' . $name . '%');
        return $object;
    }


    /**
     * 按创建时间
     * @param array $crated_at CreatedAt.
     * @return SystemEmailFilter
     */
    public function createdAt(array $crated_at): SystemEmailFilter
    {
        $object = $this;
        $number = (int) count($crated_at);
        if ($number === 1) {
            $object = $this->where('created_at', '>=', $crated_at[0]);
        } elseif ($number === 2) {
            $object = $this
                ->where('created_at', '>=', $crated_at[0])
                ->where('created_at', '<=', $crated_at[1]);
        }
        return $object;
    }

    /**
     * 按平台搜索.
     *
     * @param string $platform_sign 平台标记.
     * @return SystemEmailFilter
     */
    public function platformSign(string $platform_sign): SystemEmailFilter
    {
        $object = $this->where('platform_sign', $platform_sign);
        return $object;
    }
}
