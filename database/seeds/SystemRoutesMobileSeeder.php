<?php

use App\Models\DeveloperUsage\Frontend\SystemRoutesMobile;
use Illuminate\Database\Seeder;

/**
 * Class SystemRoutesMobileSeeder
 */
class SystemRoutesMobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        SystemRoutesMobile::insert(
            [
             [
              'route_name'        => 'app-api.login',
              'controller'        => null,
              'method'            => 'login',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.logout',
              'controller'        => null,
              'method'            => 'logout',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.password.change-code',
              'controller'        => null,
              'method'            => 'passwordChangeCode',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.password.change',
              'controller'        => null,
              'method'            => 'passwordChange',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.user.refresh-token',
              'controller'        => null,
              'method'            => 'refreshToken',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.games-lobby.rich-list',
              'controller'        => null,
              'method'            => 'richList',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.games-lobby.profit-list',
              'controller'        => null,
              'method'            => 'profitList',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.games-lobby.games-categories',
              'controller'        => null,
              'method'            => 'category',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.user.information',
              'controller'        => null,
              'method'            => 'information',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.user.game-list',
              'controller'        => null,
              'method'            => 'gameList',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.register',
              'controller'        => null,
              'method'            => 'store',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.register.verification-code',
              'controller'        => null,
              'method'            => 'code',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.user.password-reset',
              'controller'        => null,
              'method'            => 'passwordReset',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.reset-password.verification-code',
              'controller'        => null,
              'method'            => 'passwordCode',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 1,
             ],
             [
              'route_name'        => 'app-api.system.avatar',
              'controller'        => null,
              'method'            => 'avatar',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.system.banks',
              'controller'        => null,
              'method'            => 'banks',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.user.grades',
              'controller'        => null,
              'method'            => 'grades',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.user.information',
              'controller'        => null,
              'method'            => 'updateInformation',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.user.dynamic-information',
              'controller'        => null,
              'method'            => 'dynamicInformation',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.recharge.types',
              'controller'        => null,
              'method'            => 'types',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.recharge.channels',
              'controller'        => null,
              'method'            => 'channels',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.recharge.recharge',
              'controller'        => null,
              'method'            => 'recharge',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.recharge.get-finance-info',
              'controller'        => null,
              'method'            => 'getFinanceInfo',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.recharge.cancel',
              'controller'        => null,
              'method'            => 'cancel',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.recharge.confirm',
              'controller'        => null,
              'method'            => 'confirm',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.destroy',
              'controller'        => null,
              'method'            => 'accountDestroy',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.withdraw',
              'controller'        => null,
              'method'            => 'withdraw',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.recentness',
              'controller'        => null,
              'method'            => 'recent',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.records',
              'controller'        => null,
              'method'            => 'record',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.promotion-gifts',
              'controller'        => null,
              'method'            => 'promotionGift',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.weekly-gifts',
              'controller'        => null,
              'method'            => 'weeklyGift',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.list',
              'controller'        => null,
              'method'            => 'accountList',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.bank-card.binding',
              'controller'        => null,
              'method'            => 'bankCardBinding',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.alipay.binding',
              'controller'        => null,
              'method'            => 'aliPayBinding',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.bank-card.first-binding',
              'controller'        => null,
              'method'            => 'bankCardFirstBinding',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.alipay.first-binding',
              'controller'        => null,
              'method'            => 'aliPayFirstBinding',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.fund-password.check',
              'controller'        => null,
              'method'            => 'fundPasswordCheck',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.withdraw',
              'controller'        => null,
              'method'            => 'withdraw',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
             [
              'route_name'        => 'app-api.account.destroy.verification-code',
              'controller'        => null,
              'method'            => 'accountDestroyVerificationCode',
              'frontend_model_id' => null,
              'title'             => null,
              'description'       => null,
              'is_open'           => 0,
             ],
            ],
        );
    }
}
