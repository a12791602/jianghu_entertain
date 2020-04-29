<?php

namespace App\Broadcasting;

use App\Models\Admin\MerchantAdminUser;

/**
 * Class MerchantNoticeChannel
 * @package App\Broadcasting
 */
class MerchantNoticeChannel
{

    /**
     * Authenticate the user's access to the channel.
     *
     * @param MerchantAdminUser $user          MerchantAdminUser.
     * @param string            $platform_sign Platform_sign.
     * @return boolean
     */
    public function join(MerchantAdminUser $user, string $platform_sign): bool
    {
        return $user->platform_sign === $platform_sign;
    }
}
