<?php

namespace App\Models\DeveloperUsage\Menu\Logics;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 5/23/2019
 * Time: 10:02 PM
 */
trait BackendSystemMenuLogics
{
    /**
     * @return mixed[]
     */
    public function forStar(): array
    {
        $adminAccessGroupDetail = $this->find(self::ALL_MENU_REDIS_KEY)->pluck('id')->toArray();
        return $this->getMenuDatas(self::ALL_MENU_REDIS_KEY, $adminAccessGroupDetail);
    }

    /**
     * @param integer $accessGroupId          管理员组id.
     * @param array   $adminAccessGroupDetail 用户拥有的菜单权限.
     * @return mixed
     */
    public function getUserMenuDatas(int $accessGroupId, array $adminAccessGroupDetail)
    {
        return $this->getMenuDatas($accessGroupId, $adminAccessGroupDetail);
    }

    /**
     * @param string|integer $redisKey               RedisKey.
     * @param array          $adminAccessGroupDetail 管理员拥有的菜单权限.
     * @return mixed[]
     */
    public function getMenuDatas($redisKey, array $adminAccessGroupDetail = []): array
    {
        if (Cache::tags([$this->redisFirstTag])->has($redisKey)) {
            $menuData = Cache::tags([$this->redisFirstTag])->get($redisKey);
        } else {
            $menuData = self::createMenuDatas($redisKey, $adminAccessGroupDetail);
        }
        return $menuData;
    }

    /**
     * @param string|integer $redisKey               RedisKey.
     * @param array          $adminAccessGroupDetail 管理员拥有的菜单权限.
     * @return mixed[]
     */
    public function createMenuDatas($redisKey, array $adminAccessGroupDetail = []): array
    {
        $menuForFE = [];
        if ($redisKey === self::ALL_MENU_REDIS_KEY) {
            $menuLists = self::getAllFirstLevelList();
        } else {
            $menuLists = self::getFirstLevelList($adminAccessGroupDetail);
        }
        foreach ($menuLists as $firstKey => $firstMenu) {
            $menuForFE[$firstKey] = $firstMenu->toArray();
            if (!$firstMenu->childs()->exists()) {
                continue;
            }
            $childsMenu                    = $firstMenu->childs
                ->whereIn('id', $adminAccessGroupDetail)
                ->sortBy('sort')
                ->toArray();
            $menuForFE[$firstKey]['child'] = array_values($childsMenu);
        }
        Cache::tags([$this->redisFirstTag])->forever($redisKey, $menuForFE);
        return $menuForFE;
    }

    /**
     * @return boolean
     */
    public function refreshStar(): bool
    {
        Cache::tags([$this->redisFirstTag])->flush();
        return true;
    }

    /**
     * delete menu cache
     * @return void
     */
    public function deleteCache(): void
    {
        Cache::tags($this->redisFirstTag)->flush();
    }

    /**
     * @param array $parseDatas 修改的数据.
     * @throws \Exception Exception.
     * @return string
     */
    public static function changeParent(array $parseDatas): string
    {
        DB::beginTransaction();
        $menuEloq = self::find($parseDatas['id']);
        self::where(
            [
             [
              'pid',
              $menuEloq->pid,
             ],
             [
              'sort',
              '>',
              $menuEloq->sort,
             ],
            ],
        )->decrement('sort');

        self::where(
            [
             [
              'pid',
              $parseDatas['pid'],
             ],
             [
              'sort',
              '>=',
              $parseDatas['sort'],
             ],
            ],
        )->increment('sort');

        $menuEloq->fill($parseDatas);
        if (!$menuEloq->save()) {
            DB::rollback();
            throw new \Exception('300005');
        }
        DB::commit();
        return $menuEloq->label;
    }

    /**
     *
     * @return mixed.
     */
    public static function getAllFirstLevelList()
    {
        return self::where('pid', 0)->orderBy('sort')->get();
    }

    /**
     * @param array $adminAccessGroupDetail 管理员组权限.
     * @return mixed
     */
    public static function getFirstLevelList(array $adminAccessGroupDetail)
    {
        return self::where('pid', 0)->whereIn('id', $adminAccessGroupDetail)->orderBy('sort')->get();
    }
}
