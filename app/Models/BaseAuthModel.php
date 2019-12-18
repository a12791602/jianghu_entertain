<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use EloquentFilter\Filterable;
use App\Models\Traits\BaseModelLogics;

/**
 * Class for base auth model.
 */
class BaseAuthModel extends Authenticatable implements JWTSubject
{
    use Filterable,BaseModelLogics;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
