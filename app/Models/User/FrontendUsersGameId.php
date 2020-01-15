<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

/**
 * Class FrontendUsersGameId
 * @package App\Models\User
 */
class FrontendUsersGameId extends Model
{

    /**
     * @var array $guarded
     */
    protected $guarded = ['id'];

    /**
     * Generate User Unique ID to Redis.
     * @param string $brand Brand name.
     * @return void
     */
    public function generateUserUniqueID(string $brand): void
    {
        $redis = app('redis_user_unique_id');
        FrontendUsersGameId::select('user_id')->chunk(
            10000,
            static function ($items) use ($brand, $redis): void {
                foreach ($items as $item) {
                    $user_id_key = $brand . '_register_user_id';
                    $redis->sadd($user_id_key, $item->user_id);
                }
            },
        );
    }
}
