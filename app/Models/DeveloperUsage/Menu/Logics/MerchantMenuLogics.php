<?php

namespace App\Models\DeveloperUsage\Menu\Logics;

use App\Models\DeveloperUsage\Menu\MerchantSystemMenu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 5/23/2019
 * Time: 10:02 PM
 */
trait MerchantMenuLogics
{
    /**
     * @return mixed[]
     */
    public function forStar(): array
    {
        $menuDatas = $this->getMenuDatas(self::ALL_MENU_REDIS_KEY);
        return $menuDatas;
    }

    /**
     * @param  integer $accessGroupId          管理员组id.
     * @param  array   $adminAccessGroupDetail 用户拥有的菜单权限.
     * @return mixed
     */
    public function getUserMenuDatas(int $accessGroupId, array $adminAccessGroupDetail)
    {
        $menuDatas = $this->getMenuDatas($accessGroupId, $adminAccessGroupDetail);
        return $menuDatas;
    }

    /**
     * @param  string|integer $redisKey               RedisKey.
     * @param  array          $adminAccessGroupDetail 管理员拥有的菜单权限.
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
     * @param  string|integer $redisKey               RedisKey.
     * @param  array          $adminAccessGroupDetail 管理员组权限.
     * @return mixed[]
     */
    public function createMenuDatas($redisKey, array $adminAccessGroupDetail = []): array
    {
        $menuForFE = [];
        if ($redisKey === self::ALL_MENU_REDIS_KEY) {
            $menuLists              = self::getAllFirstLevelList();
            $adminAccessGroupDetail = $this->pluck('id')->toArray();
        } else {
            $menuLists = self::getFirstLevelList($adminAccessGroupDetail);
        }
        foreach ($menuLists as $firstMenu) {
            $menuForFE[$firstMenu->id] = $firstMenu->toArray();
            if (!$firstMenu->childs()->exists()) {
                continue;
            }
            $menuForFE = $this->_getMenuChilds($adminAccessGroupDetail, $firstMenu, $menuForFE);
        }
        Cache::tags([$this->redisFirstTag])->forever($redisKey, $menuForFE);
        return $menuForFE;
    }

    /**
     * Gets menu childs.
     *
     * @param array              $adminAccessGroupDetail 管理员组权限.
     * @param MerchantSystemMenu $firstMenu              BackendSystemMenu.
     * @param array              $menuForFE              整理后的管理员组权限.
     *
     * @return mixed[]
     */
    private function _getMenuChilds(
        array $adminAccessGroupDetail,
        MerchantSystemMenu $firstMenu,
        array $menuForFE
    ): array {
        $firstChilds = $firstMenu->childs->whereIn('id', $adminAccessGroupDetail)->sortBy('sort');
        foreach ($firstChilds as $secondMenu) {
            $menuForFE[$firstMenu->id]['child'][$secondMenu->id] = $secondMenu->toArray();
            if (!$secondMenu->childs()->exists()) {
                continue;
            }
            $secondChilds = $secondMenu->childs->whereIn('id', $adminAccessGroupDetail)->sortBy('sort');
            foreach ($secondChilds as $thirdMenu) {
                $menuForFE[$firstMenu->id]['child'][$secondMenu->id]['child'][$thirdMenu->id]
                    = $thirdMenu->toArray();
            }
        }
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
     * @param  array $parseDatas 修改的数据.
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
            throw new \Exception('202803');
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
        $allFirstLevelList = self::where('pid', 0)->orderBy('sort')->get();
        return $allFirstLevelList;
    }

    /**
     * @param  array $adminAccessGroupDetail 管理员组权限.
     * @return mixed
     */
    public static function getFirstLevelList(array $adminAccessGroupDetail)
    {
        $firstLevelList = self::where('pid', 0)->whereIn('id', $adminAccessGroupDetail)->orderBy('sort')->get();
        return $firstLevelList;
    }
}
