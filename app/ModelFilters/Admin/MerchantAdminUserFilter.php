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
        return $this->where('id', $dataId);
    }

    /**
     * @param string $platform 平台标识.
     * @return MerchantAdminUserFilter
     */
    public function platform(string $platform): MerchantAdminUserFilter
    {
        return $this->where('platform_sign', $platform);
    }

    /**
     * @param string $string 搜索的字符串.
     *
     * @return MerchantAdminUserFilter
     */
    public function searchStr(string $string): MerchantAdminUserFilter
    {
        return $this->whereLike('name', $string)->orWhere('email', 'like', '%' . $string . '%');
    }

    /**
     * 名称搜索
     * @param string $author_name AuthorName.
     * @return MerchantAdminUserFilter
     */
    public function authorName(string $author_name): MerchantAdminUserFilter
    {
        return $this->where('name', $author_name);
    }

    /**
     * 名称搜索
     * @param string $last_editor_name LastEditorName.
     * @return MerchantAdminUserFilter
     */
    public function lastEditorName(string $last_editor_name): MerchantAdminUserFilter
    {
        return $this->where('name', $last_editor_name);
    }

    /**
     * 邮箱查询
     *
     * @param  string $email 邮箱.
     * @return MerchantAdminUserFilter
     */
    public function email(string $email): MerchantAdminUserFilter
    {
        return $this->where('email', $email);
    }

    /**
     * 按名称搜索.
     *
     * @param string $reviewer 名称.
     * @return MerchantAdminUserFilter
     */
    public function reviewer(string $reviewer): MerchantAdminUserFilter
    {
        return $this->where('name', $reviewer);
    }

    /**
     * 按名称搜索.
     *
     * @param string $admin 名称.
     * @return MerchantAdminUserFilter
     */
    public function admin(string $admin): MerchantAdminUserFilter
    {
        return $this->where('name', $admin);
    }
}
