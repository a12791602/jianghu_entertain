<?php

namespace App\ModelFilters\Systems;

use Carbon\Carbon;
use EloquentFilter\ModelFilter;

/**
 *  运营商平台
 */
class SystemPlatformFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [
                         'owner' => ['email'],
                        ];

    /**
     * 状态查询
     *
     * @param  string $status 状态.
     * @return self
     */
    public function status(string $status): self
    {
        return $this->where('status', $status);
    }

    /**
     * 生成时间
     *
     * @param  string $createdStr 生成时间.
     * @return self|\Illuminate\Database\Eloquent\Builder
     */
    public function createdAt(string $createdStr)
    {
        $createdArr = json_decode($createdStr, true);
        if (!is_array($createdArr) || count($createdArr) !== 2) {
            $eloq = $this;
        } else {
            $eloq = $this->whereBetween('created_at', $createdArr);
        }//end if
        return $eloq;
    }

    /**
     * 当前维护状态查询
     *
     * @param  integer $maintain 状态.
     * @return self
     */
    public function maintain(int $maintain): self
    {
        $eloq = $this;
        $time = Carbon::now();
        if ($maintain === 0) {
            $eloq = $this->where(
                [
                 [
                  'maintain_start',
                  null,
                 ],
                 [
                  'maintain_end',
                  null,
                 ],
                ],
            )->orWhere('maintain_start', '>', $time)
            ->orWhere('maintain_end', '<', $time);
        } elseif ($maintain === 1) {
            $eloq = $this->where(
                [
                 [
                  'maintain_start',
                  '<=',
                  $time,
                 ],
                 [
                  'maintain_end',
                  '>=',
                  $time,
                 ],
                ],
            );
        }//end if
        return $eloq;
    }

    /**
     * 平台名称
     * @param  string $name 平台名称.
     * @return self
     */
    public function platformName(string $name): self
    {
        return $this->whereLike('cn_name', $name);
    }
}
