<?php

namespace App\ModelFilters\Email;

use EloquentFilter\ModelFilter;

/**
 * Class SystemEmailSendFilter
 *
 * @package App\ModelFilters\Email
 */
class SystemEmailSendFilter extends ModelFilter
{

    /**
     * Related Models that have ModelFilters as well as the method on the ModelFilter
     * As [relationMethod => [input_key1, input_key2]].
     *
     * @var array
     */
    public $relations = ['email' => 'title'];
}
