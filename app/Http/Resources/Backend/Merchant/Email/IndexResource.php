<?php

namespace App\Http\Resources\Backend\Merchant\Email;

use App\Http\Resources\BaseResource;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Email\SystemEmail;
use App\Models\Finance\SystemFinanceType;
use App\Models\Finance\SystemFinanceUserTag;
use App\Models\User\UsersTag;
use Carbon\Carbon;

/**
 * Class IndexResource
 * @package App\Http\Resources\Backend\Merchant\Email
 */
class IndexResource extends BaseResource
{

    /**
     * @var integer $id Id.
     */
    private $id;

    /**
     * @var SystemEmail $email SystemEmail.
     */
    private $email;


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
                'id'        => $this->id,
                'title'     => $this->email->title,
                'content'   => $this->email->content,
                'is_send'   => $this->email->is_send,
                'send_time' => $this->email->send_time,
               ];
    }
}
