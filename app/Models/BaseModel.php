<?php

namespace App\Models;

use DateTimeInterface;
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

    protected $perPage = 50;

    /**
     * Prepare a date for array / JSON serialization.
     *
     * @param  DateTimeInterface $date DateTimeInterface.
     * @return string
     */
    protected function serializeDate(DateTimeInterface $date): string
    {
        $date = $date->format('Y-m-d H:i:s');
        return $date;
    }
}
