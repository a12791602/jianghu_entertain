<?php

use Illuminate\Database\Seeder;

/**
 * Class DatabaseSeeder
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call(
            [
             SystemDynActivitySeeder::class,
             BackendAdminAccessGroupSeeder::class,
             BackendAdminAccessGroupDetailSeeder::class,
             BackendAdminUserSeeder::class,
             BackendSystemMenuSeeder::class,
             FrontendUserSeeder::class,
             FrontendUserAccountSeeder::class,
             FrontendUserAccountTypeSeeder::class,
             FrontendUserAccountTypeParamSeeder::class,
             FrontendUsersSpecificInfoSeeder::class,
             FrontendUserLevelsSeeder::class,
             FrontendUserLevelBenefitSeeder::class,
             MerchantSystemMenuSeeder::class,
             MerchantAdminAccessGroupSeeder::class,
             MerchantAdminUserSeeder::class,
             SystemPlatformSeeder::class,
             SystemRoutesBackendSeeder::class,
             SystemRoutesH5Seeder::class,
             SystemRoutesMerchantSeeder::class,
             SystemRoutesMobileSeeder::class,
             GameTypeSeeder::class,
             GameVendorSeeder::class,
             GameSeeder::class,
             GameTypeChildSeeder::class,
             GameTypePlatformSeeder::class,
             GamePlatformSeeder::class,
             GameVendorUrlFieldSeeder::class,
             SystemDomainSeeder::class,
             SystemFePageBannerSeeder::class,
             GameVendorPlatformSeeder::class,
             SystemFinanceUserTagSeeder::class,
             MerchantAdminAccessGroupsHasBackendSystemMenuSeeder::class,
             SystemBankSeeder::class,
             SystemPlatformBankSeeder::class,
             SystemFinanceChannelSeeder::class,
             SystemFinanceOfflineInfoSeeder::class,
             SystemFinanceOnlineInfoSeeder::class,
             SystemFinanceTypeSeeder::class,
             SystemFinanceVendorSeeder::class,
             SystemIpWhiteListSeeder::class,
             UsersTagSeeder::class,
             SystemPlatformSslSeeder::class,
             SystemConfigurationSeeder::class,
             SystemUserPublicAvatarSeeder::class,
             FrontendUsersBankCardSeeder::class,
             SystemConfigurationStandardSeeder::class,
             FrontendUserAccountTypesGroupSeeder::class,
            ],
        );
    }
}
