<?php

namespace App\ModelFilters\Admin;

use EloquentFilter\ModelFilter;

/**
 * Class for merchant admin user filter.
 */
class MerchantAdminUserFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = [];

    /**
     * @param integer $dataId ID.
     * @return MerchantAdminUserFilter
     */
    public function dataId(int $dataId): MerchantAdminUserFilter
    {
        $object = $this->where('id', $dataId);
        return $object;
    }

    /**
     * @param string $platform 平台标识.
     * @return MerchantAdminUserFilter
     */
    public function platform(string $platform): MerchantAdminUserFilter
    {
        $object = $this->where('platform_sign', $platform);
        return $object;
    }

    /**
     * @param string $string 搜索的字符串.
     * @return MerchantAdminUserFilter
     */
    public function searchNameEmail(string $string): MerchantAdminUserFilter
    {
        $object = $this->whereLike('name', $string)->orWhere('email', 'like', '%' . $string . '%');
        return $object;
    }

    /**
     * 名称搜索
     * @param string $author_name AuthorName.
     * @return MerchantAdminUserFilter
     */
    public function authorName(string $author_name): MerchantAdminUserFilter
    {
        $object = $this->where('name', $author_name);
        return $object;
    }

    /**
     * 名称搜索
     * @param string $last_editor_name LastEditorName.
     * @return MerchantAdminUserFilter
     */
    public function lastEditorName(string $last_editor_name): MerchantAdminUserFilter
    {
        $object = $this->where('name', $last_editor_name);
        return $object;
    }

    /**
     * 邮箱查询
     *
     * @param  string $email 邮箱.
     * @return MerchantAdminUserFilter
     */
    public function email(string $email): MerchantAdminUserFilter
    {
        $object = $this->where('email', $email);
        return $object;
    }

    /**
     * 按名称搜索.
     *
     * @param string $reviewer 名称.
     * @return MerchantAdminUserFilter
     */
    public function reviewer(string $reviewer): MerchantAdminUserFilter
    {
        $object = $this->where('name', $reviewer);
        return $object;
    }

    /**
     * 按名称搜索.
     *
     * @param string $admin 名称.
     * @return MerchantAdminUserFilter
     */
    public function admin(string $admin): MerchantAdminUserFilter
    {
        $object = $this->where('name', $admin);
        return $object;
    }
}
