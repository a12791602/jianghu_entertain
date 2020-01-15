<?php

namespace App\Models\DeveloperUsage\Menu\Traits;

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Support\Facades\Cache;

/**
 * Created by PhpStorm.
 * author: Harris
 * Date: 5/23/2019
 * Time: 10:02 PM
 */
trait MenuLogics
{
    /**
     * @return mixed[]
     */
    public function forStar(): array
    {
        $adminAccessGroupDetail = $this->find(self::ALL_MENU_REDIS_KEY)->pluck('id')->toArray();
        $menuData               = $this->getMenuDatas(self::ALL_MENU_REDIS_KEY, $adminAccessGroupDetail);
        return $menuData;
    }

    /**
     * @param integer $accessGroupId          管理员组id.
     * @param array   $adminAccessGroupDetail 用户拥有的菜单权限.
     * @return mixed
     */
    public function getUserMenuDatas(int $accessGroupId, array $adminAccessGroupDetail)
    {
        $userMenuDatas = $this->getMenuDatas($accessGroupId, $adminAccessGroupDetail);
        return $userMenuDatas;
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
     * @param array             $adminAccessGroupDetail 管理员组权限.
     * @param BackendSystemMenu $firstMenu              BackendSystemMenu.
     * @param array             $menuForFE              整理后的管理员组权限.
     *
     * @return mixed[]
     */
    private function _getMenuChilds(
        array $adminAccessGroupDetail,
        BackendSystemMenu $firstMenu,
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
     *
     * @return mixed.
     */
    public static function getAllFirstLevelList()
    {
        $allFirstLevelList = self::where('pid', 0)->orderBy('sort')->get();
        return $allFirstLevelList;
    }

    /**
     * @param array $adminAccessGroupDetail 管理员组权限.
     * @return mixed
     */
    public static function getFirstLevelList(array $adminAccessGroupDetail)
    {
        $firstLevelList = self::where('pid', 0)->whereIn('id', $adminAccessGroupDetail)->orderBy('sort')->get();
        return $firstLevelList;
    }

    /**
     * @param array $parseDatas 修改的数据.
     * @return mixed[]
     */
    public function changeParent(array $parseDatas): array
    {
        $atLeastOne  = false;
        $itemProcess = [];
        foreach ($parseDatas as $value) {
            $menuEloq       = self::find($value['currentId']);
            $menuEloq->pid  = $value['currentParent'] === '#' ? 0 : (int) $value['currentParent'];
            $menuEloq->sort = $value['currentSort'];
            if ($menuEloq->save()) {
                $pass          = ['pass' => $value['currentText']];
                $itemProcess[] = $pass;
                $atLeastOne    = true;
            } else {
                $fail          = ['fail' => $value['currentText']];
                $itemProcess[] = $fail;
            }
        }
        if ($atLeastOne === true && isset($menuEloq)) {
            $menuEloq->refreshStar();
        }
        return $itemProcess;
    }
}
