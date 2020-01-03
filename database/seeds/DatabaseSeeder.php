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
                FrontendUserSpecificInfoSeeder::class,
                MerchantSystemMenuSeeder::class,
                MerchantAdminAccessGroupSeeder::class,
                MerchantAdminUserSeeder::class,
                MerchantSystemMenuSeeder::class,
                SystemPlatformSeeder::class,
                SystemRoutesBackendSeeder::class,
                SystemRoutesH5Seeder::class,
                SystemRoutesMerchantSeeder::class,
                SystemRoutesMobileSeeder::class,
                GamePlatformSeeder::class,
                GameSeeder::class,
                GameTypeSeeder::class,
                GameTypePlatformSeeder::class,
                SystemDomainSeeder::class,
                SystemFePageBannerSeeder::class,
                GameVendorPlatformSeeder::class,
                SystemFinanceUserTagSeeder::class,
            ],
        );
    }
}
