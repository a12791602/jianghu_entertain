<?php

namespace App\Listeners;

use App\Events\SystemEmailEvent;
use App\Models\Admin\BackendAdminUser;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Email\SystemEmail;
use App\Models\Email\SystemEmailReceiver;
use App\Models\User\FrontendUser;

/**
 * Class SystemEmailEventListener
 *
 * @package App\Listeners
 */
class SystemEmailEventListener
{

    /**
     * @var SystemEmail
     */
    private $systemEmail;

    /**
     * @var SystemEmailReceiver
     */
    private $systemEmailReceiver;

    /**
     * SystemEmailEventListener constructor.
     *
     * @param  SystemEmail         $systemEmail         SystemEmail.
     * @param  SystemEmailReceiver $systemEmailReceiver SystemEmailReceiver.
     * @return void
     */
    public function __construct(SystemEmail $systemEmail, SystemEmailReceiver $systemEmailReceiver)
    {
        $this->systemEmail         = $systemEmail;
        $this->systemEmailReceiver = $systemEmailReceiver;
    }

    /**
     * Handle the event.
     *
     * @param  SystemEmailEvent $event Event.
     * @return void
     */
    public function handle(SystemEmailEvent $event): void
    {
        $tmpData                  = [];
        $receiverIds              = $this->_getReceiverIds($event);
        $tmpData['email_id']      = $event->emailId;
        $tmpData['receiver_type'] = $event->receiverType;
        $tmpData['platform_sign'] = $event->platformSign;
        $data                     = [];
        foreach ($receiverIds as $receiverId) {
            $tmpData['receiver_id'] = $receiverId;
            $data[]                 = $tmpData;
        }
        $this->systemEmailReceiver::insert($data);
        $this->systemEmail->where('id', $event->emailId)->update(['is_send' => SystemEmail::IS_SEND_YES]);
    }

    /**
     * @param  SystemEmailEvent $event Event.
     * @return mixed[]
     */
    private function _getReceiverIds(SystemEmailEvent $event): array
    {
        $receiverIds = [];
        if ((int) $event->receiverType === (int) SystemEmailReceiver::RECEIVER_TYPE_PLAYER) {
            $receiverIds = FrontendUser::where(
                'platform_sign',
                $event->platformSign,
            )->whereIn('uid', $event->receivers)->get()->pluck('id')->toArray();
        } elseif ((int) $event->receiverType === (int) SystemEmailReceiver::RECEIVER_TYPE_MERCHANT) {
            $receiverIds = MerchantAdminUser::whereIn('email', $event->receivers)->get()->pluck('id')->toArray();
        } elseif ((int) $event->receiverType === (int) SystemEmailReceiver::RECEIVER_TYPE_HEADQUARTERS) {
            $receiverIds = BackendAdminUser::select('id')->get()->pluck('id')->toArray();
        }
        return $receiverIds;
    }
}
