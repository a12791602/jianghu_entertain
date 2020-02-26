<?php

namespace App\Models;

use App\Models\Logics\BaseModelLogics;
use EloquentFilter\Filterable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * Class for base auth model.
 */
class BaseAuthModel extends Authenticatable implements JWTSubject
{
    use Filterable;
    use BaseModelLogics;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        $jwtKey = $this->getKey();
        return $jwtKey;
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return mixed
     */
    public function getJWTCustomClaims()
    {
        $claim = [];
        return $claim;
    }
}
