<?php

namespace App\Models\Finance;

use App\Models\BaseModel;

/**
 * Class SystemFinanceUserTag
 * @package App\Models\Finance
 */
class SystemFinanceUserTag extends BaseModel
{

    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['tag_id' => 'array'];
}
