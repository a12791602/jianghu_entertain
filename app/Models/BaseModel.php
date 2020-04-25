<?php

namespace App\Models;

use App\Models\Logics\BaseModelLogics;
use EloquentFilter\Filterable;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Models
 */
class BaseModel extends Model
{
    use Cachable;
    use Filterable;
    use BaseModelLogics;

    /**
     * @var integer
     */
    protected $perPage = 50;
}
