<?php

namespace App\Http\Resources\Backend\Merchant\Email;

use App\Http\Resources\BaseResource;
use App\Models\Email\SystemEmail;

/**
 * Class ReceivedIndexResource
 * @package App\Http\Resources\Backend\Merchant\Email
 */
class ReceivedIndexResource extends BaseResource
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
                'id'         => $this->id,
                'title'      => $this->email->title,
                'content'    => $this->email->content,
                'is_read'    => $this->email->is_read,
                'sender'     => $this->email->headquarters->name ?? '',
                'created_at' => $this->email->send_time,
               ];
    }
}
