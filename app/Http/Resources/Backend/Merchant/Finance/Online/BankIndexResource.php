<?php

namespace App\Http\Resources\Backend\Merchant\Finance\Online;

use App\Http\Resources\BaseResource;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Finance\SystemBank;
use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use App\Models\User\UsersTag;
use Carbon\Carbon;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Merchant\User\FrontendUser
 */
class BankIndexResource extends BaseResource
{

    /**
     * @var integer $id Id.
     */
    private $id;

    /**
     * @var SystemBank $bank SystemBank.
     */
    private $bank;

    /**
     * @var MerchantAdminUser $lastEditor 最近一次编辑人.
     */
    private $lastEditor;

    /**
     * @var Carbon $updated_at Updated_at.
     */
    private $updated_at;

    /**
     * @var integer $status Status.
     */
    private $status;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request Request.
     * @return mixed[]
     */
    public function toArray($request): array
    {
        unset($request);
        return [
                'id'          => $this->id,
                'bank'        => $this->bank->name,
                'status'      => $this->status,
                'last_editor' => $this->lastEditor->name,
                'updated_at'  => $this->updated_at->toDatetimeString(),
               ];
    }
}
