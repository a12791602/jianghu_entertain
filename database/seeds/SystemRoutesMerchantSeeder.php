<?php

use App\Models\DeveloperUsage\Merchant\SystemRoutesMerchant;
use Illuminate\Database\Seeder;

/**
 * Class SystemRoutesMerchantSeeder
 */
class SystemRoutesMerchantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemRoutesMerchant::insert(
            [
             [
              'route_name'    => 'merchant-api.login',
              'controller'    => null,
              'method'        => 'login',
              'menu_group_id' => 57,
              'title'         => '登录',
              'is_open'       => 1,
             ],
             [
              'route_name'    => 'merchant-api.logout',
              'controller'    => null,
              'method'        => 'logout',
              'menu_group_id' => 57,
              'title'         => '登出',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.menu.current-admin-menu',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 57,
              'title'         => '当前管理员拥有的菜单',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-group.detail',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员组-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-group.create',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员组-添加',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-group.edit',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员组-编辑',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-group.delete',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员组-删除',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-group.specific-group-users',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员组-管理员列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-user.get-all-admins',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员-所有管理员',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-user.create',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员-添加',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-user.update-admin-group',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员-更换组',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-user.delete-admin',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员-删除',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-user.search-admin',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 51,
              'title'         => '管理员-搜索',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.merchant-admin-user.switch-admin',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 51,
              'title'         => '管理员-禁用启用',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.frontend-user.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 4,
              'title'         => '会员列表-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.frontend-user.login-log',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 5,
              'title'         => '会员登录记录-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-tags.index',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 6,
              'title'         => '会员标签-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-tags.do-add',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 6,
              'title'         => '会员标签-添加',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-tags.edit',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 6,
              'title'         => '会员标签-编辑',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-tags.delete',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 6,
              'title'         => '会员标签-删除',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.frontend-user-black-list.index',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 7,
              'title'         => '会员黑名单-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.frontend-user-black-list.detail',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 7,
              'title'         => '会员黑名单-详情',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.frontend-user-black-list.remove',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 7,
              'title'         => '会员黑名单-启用',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-grade.config',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 8,
              'title'         => '会员等级-晋级规则',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-grade.index',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 8,
              'title'         => '会员等级-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-grade.do-add',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 8,
              'title'         => '会员等级-添加',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-grade.edit',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 8,
              'title'         => '会员等级-编辑',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.user-grade.delete',
              'controller'    => null,
              'method'        => '',
              'menu_group_id' => 8,
              'title'         => '会员等级-删除',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.commission.index',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 9,
              'title'         => '洗码设置-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.commission.do-add',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 9,
              'title'         => '洗码设置-添加',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.commission.edit',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 9,
              'title'         => '洗码设置-编辑',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.commission.delete',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 9,
              'title'         => '洗码设置-删除',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.costomer-service.index',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 53,
              'title'         => '客服设置-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.costomer-service.do-add',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 53,
              'title'         => '客服设置-添加',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.costomer-service.edit',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 53,
              'title'         => '客服设置-编辑',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.costomer-service.delete',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 53,
              'title'         => '客服设置-删除',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.help-center.index',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 54,
              'title'         => '帮助设置-列表',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.help-center.do-add',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 54,
              'title'         => '帮助设置-添加',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.help-center.edit',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 54,
              'title'         => '帮助设置-编辑',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.help-center.delete',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 54,
              'title'         => '帮助设置-删除',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game-type.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game-type.status',
              'controller'    => null,
              'method'        => 'status',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game-vendor.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game-vendor.status',
              'controller'    => null,
              'method'        => 'status',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game-vendor.sort',
              'controller'    => null,
              'method'        => 'sort',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.app-index',
              'controller'    => null,
              'method'        => 'appIndex',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.status',
              'controller'    => null,
              'method'        => 'status',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.do-hot',
              'controller'    => null,
              'method'        => 'doHot',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.sort',
              'controller'    => null,
              'method'        => 'sort',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.maintain',
              'controller'    => null,
              'method'        => 'maintain',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.recommend',
              'controller'    => null,
              'method'        => 'recommend',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.get-search-condition-data',
              'controller'    => null,
              'method'        => 'getSearchConditionData',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.h5-index',
              'controller'    => null,
              'method'        => 'h5Index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.pc-index',
              'controller'    => null,
              'method'        => 'pcIndex',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.offline-finance.add-do',
              'controller'    => null,
              'method'        => 'addDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.offline-finance.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.offline-finance.edit',
              'controller'    => null,
              'method'        => 'edit',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.offline-finance.del-do',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.offline-finance.status',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.offline-finance.edit',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.online-finance.get-channels',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.online-finance.add-do',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.upload',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.bank-cards.index',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.bank-cards.delete',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.online-finance.index',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.online-finance.edit',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.online-finance.del-do',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.online-finance.status',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.offline-finance.types',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.bank.get-system-banks',
              'controller'    => null,
              'method'        => null,
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.game.ackIn',
              'controller'    => null,
              'method'        => 'ackIn',
              'menu_group_id' => null,
              'title'         => '',
              'is_open'       => 1,
             ],
             [
              'route_name'    => 'merchant-api.game.ackOut',
              'controller'    => null,
              'method'        => 'ackOut',
              'menu_group_id' => null,
              'title'         => '',
              'is_open'       => 1,
             ],
             [
              'route_name'    => 'merchant-api.marquee-notice.add-do',
              'controller'    => null,
              'method'        => 'addDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.marquee-notice.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.marquee-notice.edit',
              'controller'    => null,
              'method'        => 'edit',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.marquee-notice.del-do',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.marquee-notice.status',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.system-notice.add-do',
              'controller'    => null,
              'method'        => 'addDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.system-notice.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.system-notice.edit',
              'controller'    => null,
              'method'        => 'edit',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.system-notice.del-do',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.system-notice.status',
              'controller'    => null,
              'method'        => 'status',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.login-notice.add-do',
              'controller'    => null,
              'method'        => 'addDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.login-notice.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.login-notice.edit',
              'controller'    => null,
              'method'        => 'edit',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.login-notice.del-do',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.login-notice.status',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.carousel-notice.add-do',
              'controller'    => null,
              'method'        => 'addDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.carousel-notice.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.carousel-notice.edit',
              'controller'    => null,
              'method'        => 'edit',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.carousel-notice.del-do',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.carousel-notice.status',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-static.add-do',
              'controller'    => null,
              'method'        => 'addDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-static.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-static.edit',
              'controller'    => null,
              'method'        => 'edit',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-static.del-do',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-static.status',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.bank.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.bank.status',
              'controller'    => null,
              'method'        => 'delDo',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.email.send',
              'controller'    => null,
              'method'        => 'send',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.email.send-index',
              'controller'    => null,
              'method'        => 'sendIndex',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.email.received-index',
              'controller'    => null,
              'method'        => 'receivedIndex',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-dyn.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-dyn.status',
              'controller'    => null,
              'method'        => 'status',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.activity-dyn.save-pic',
              'controller'    => null,
              'method'        => 'savePic',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.email.read-email',
              'controller'    => null,
              'method'        => 'readEmail',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.recharge-order.index',
              'controller'    => null,
              'method'        => 'index',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.recharge-order.get-finance-types',
              'controller'    => null,
              'method'        => 'getFinanceTypes',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.recharge-order.handle-success',
              'controller'    => null,
              'method'        => 'handleSuccess',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.recharge-order.check-pass',
              'controller'    => null,
              'method'        => 'checkPass',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.recharge-order.check-refuse',
              'controller'    => null,
              'method'        => 'checkRefuse',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.handle-save-buckle.handle-save',
              'controller'    => null,
              'method'        => 'handleSave',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.handle-save-buckle.save-index',
              'controller'    => null,
              'method'        => 'saveIndex',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.handle-save-buckle.handle-buckle',
              'controller'    => null,
              'method'        => 'handleBuckle',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
             [
              'route_name'    => 'merchant-api.handle-save-buckle.buckle-index',
              'controller'    => null,
              'method'        => 'buckleIndex',
              'menu_group_id' => 2,
              'title'         => '',
              'is_open'       => 0,
             ],
            ],
        );
    }
}
