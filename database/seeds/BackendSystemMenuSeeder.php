<?php

use App\Models\DeveloperUsage\Menu\BackendSystemMenu;
use Illuminate\Database\Seeder;

/**
 * Class BackendSystemMenuSeeder
 */
class BackendSystemMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        BackendSystemMenu::insert(
            [
             [
              'id'      => '1',
              'label'   => '首页',
              'en_name' => 'home',
              'route'   => '/home',
              'pid'     => 0,
              'icon'    => 'iconhome',
              'display' => 1,
              'level'   => 1,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '2',
              'label'   => '首页内容',
              'en_name' => 'Home',
              'route'   => '/home/home',
              'pid'     => 1,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '3',
              'label'   => '厅主管理',
              'en_name' => 'hall',
              'route'   => '/hall',
              'pid'     => 0,
              'icon'    => 'iconaccount',
              'display' => 1,
              'level'   => 1,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '4',
              'label'   => '厅主列表',
              'en_name' => 'HallList',
              'route'   => '/hall/halllist',
              'pid'     => 3,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '5',
              'label'   => '登录记录',
              'en_name' => 'LoginRecord',
              'route'   => '/hall/loginrecord',
              'pid'     => 3,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '6',
              'label'   => '游戏管理',
              'en_name' => '',
              'route'   => '',
              'pid'     => 0,
              'icon'    => 'icongame',
              'display' => 1,
              'level'   => 1,
              'sort'    => 3,
              'type'    => 1,
             ],
             [
              'id'      => '7',
              'label'   => '厂商管理',
              'en_name' => 'VendorManage',
              'route'   => '/game/vendormanage',
              'pid'     => 6,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '8',
              'label'   => '分类设置',
              'en_name' => 'SortSet',
              'route'   => '/game/sortset',
              'pid'     => 6,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '9',
              'label'   => '游戏设置',
              'en_name' => 'GameManage',
              'route'   => '/game/gamemanage',
              'pid'     => 6,
              'icon'    => 'iconhuodong',
              'display' => 1,
              'level'   => 2,
              'sort'    => 3,
              'type'    => 1,
             ],
             [
              'id'      => '10',
              'label'   => '活动管理',
              'en_name' => 'active',
              'route'   => '',
              'pid'     => 0,
              'icon'    => null,
              'display' => 1,
              'level'   => 1,
              'sort'    => 4,
              'type'    => 1,
             ],
             [
              'id'      => '11',
              'label'   => '活动列表',
              'en_name' => 'ActiveList',
              'route'   => '/active/activelist',
              'pid'     => 10,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '12',
              'label'   => '邮件系统',
              'en_name' => 'email',
              'route'   => '/email',
              'pid'     => 0,
              'icon'    => 'icon185078emailmailstreamline',
              'display' => 1,
              'level'   => 1,
              'sort'    => 5,
              'type'    => 1,
             ],
             [
              'id'      => '13',
              'label'   => '发邮件',
              'en_name' => 'SendEmail',
              'route'   => '/email/sendemail',
              'pid'     => 12,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '14',
              'label'   => '收件箱',
              'en_name' => 'ReceiveEmail',
              'route'   => '/email/receiveemail',
              'pid'     => 12,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '15',
              'label'   => '已发邮件',
              'en_name' => 'EmailSent',
              'route'   => '/email/emailsent',
              'pid'     => 12,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 3,
              'type'    => 1,
             ],
             [
              'id'      => '16',
              'label'   => '报表管理',
              'en_name' => 'report',
              'route'   => '',
              'pid'     => 0,
              'icon'    => 'iconassistant_lefticon_Statisticalreportforms',
              'display' => 1,
              'level'   => 1,
              'sort'    => 6,
              'type'    => 1,
             ],
             [
              'id'      => '17',
              'label'   => '厅主注单报表',
              'en_name' => 'HallRegist',
              'route'   => '/report/hallregist',
              'pid'     => 16,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '18',
              'label'   => '第三方游戏报表',
              'en_name' => 'ThirdGame',
              'route'   => '/report/thirdgame',
              'pid'     => 16,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '19',
              'label'   => '厅主游戏报表',
              'en_name' => 'HallGame',
              'route'   => '/report/hallgame',
              'pid'     => 16,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 3,
              'type'    => 1,
             ],
             [
              'id'      => '20',
              'label'   => '厅主充提报表',
              'en_name' => 'HallDeposit',
              'route'   => '/report/halldeposit',
              'pid'     => 16,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 4,
              'type'    => 1,
             ],
             [
              'id'      => '21',
              'label'   => '金流配置',
              'en_name' => 'cashflow',
              'route'   => '',
              'pid'     => 0,
              'icon'    => 'iconmoneybag',
              'display' => 1,
              'level'   => 1,
              'sort'    => 7,
              'type'    => 1,
             ],
             [
              'id'      => '22',
              'label'   => '厂商管理',
              'en_name' => 'CashFlowVendor',
              'route'   => '/cashflow/cashflowvendor',
              'pid'     => 21,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '23',
              'label'   => '分类管理',
              'en_name' => 'CashFlowSort',
              'route'   => '/cashflow/cashflowsort',
              'pid'     => 21,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '24',
              'label'   => '通道管理',
              'en_name' => 'ChannelManage',
              'route'   => '/cashflow/channelmanage',
              'pid'     => 21,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 3,
              'type'    => 1,
             ],
             [
              'id'      => '25',
              'label'   => '设置管理',
              'en_name' => 'set',
              'route'   => '',
              'pid'     => 0,
              'icon'    => 'iconshezhi2',
              'display' => 1,
              'level'   => 1,
              'sort'    => 8,
              'type'    => 1,
             ],
             [
              'id'      => '26',
              'label'   => '管理员分组',
              'en_name' => 'AdminSort',
              'route'   => '/set/adminsort',
              'pid'     => 25,
              'icon'    => null,
              'display' => 1,
              'level'   => 5,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '27',
              'label'   => '操作日志',
              'en_name' => 'OperatLog',
              'route'   => '/set/operatlog',
              'pid'     => 25,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '28',
              'label'   => '短信配置',
              'en_name' => 'SmsConfig',
              'route'   => '/set/smsconfig',
              'pid'     => 25,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 3,
              'type'    => 1,
             ],
             [
              'id'      => '29',
              'label'   => '开发管理',
              'en_name' => 'dev',
              'route'   => '',
              'pid'     => 0,
              'icon'    => 'iconkaifa',
              'display' => 1,
              'level'   => 1,
              'sort'    => 9,
              'type'    => 1,
             ],
             [
              'id'      => '30',
              'label'   => '总控菜单管理',
              'en_name' => 'TotalMenu',
              'route'   => '/dev/totalmenu',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 1,
              'type'    => 1,
             ],
             [
              'id'      => '31',
              'label'   => '厅主菜单管理',
              'en_name' => 'HallMenu',
              'route'   => '/dev/hallmenu',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 2,
              'type'    => 1,
             ],
             [
              'id'      => '33',
              'label'   => '游戏分类配置',
              'en_name' => 'GameSort',
              'route'   => '/dev/gamesort',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 4,
              'type'    => 1,
             ],
             [
              'id'      => '34',
              'label'   => '游戏管理配置',
              'en_name' => 'GameManaConfig',
              'route'   => '/dev/gamemanaconfig',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 5,
              'type'    => 1,
             ],
             [
              'id'      => '35',
              'label'   => '金流厂商配置',
              'en_name' => 'CashVendorConfig',
              'route'   => '/dev/cashvendorconfig',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 6,
              'type'    => 1,
             ],
             [
              'id'      => '36',
              'label'   => '金流分类管理',
              'en_name' => 'CashSort',
              'route'   => '/dev/cashsort',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 7,
              'type'    => 1,
             ],
             [
              'id'      => '37',
              'label'   => '金流通道配置',
              'en_name' => 'CashChannel',
              'route'   => '/dev/cashchannel',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 8,
              'type'    => 1,
             ],
             [
              'id'      => '38',
              'label'   => '金流银行卡配置',
              'en_name' => 'CashBankCard',
              'route'   => '/dev/cashbankcard',
              'pid'     => 29,
              'icon'    => null,
              'display' => 1,
              'level'   => 2,
              'sort'    => 9,
              'type'    => 1,
             ],
             [
              'id'      => '39',
              'label'   => '全域',
              'en_name' => '',
              'route'   => '',
              'pid'     => 0,
              'icon'    => null,
              'display' => 0,
              'level'   => 1,
              'sort'    => 10,
              'type'    => 1,
             ],
            ],
        );
    }
}
