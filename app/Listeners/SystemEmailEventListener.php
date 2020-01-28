<?php

namespace App\Listeners;

use App\Events\SystemEmailEvent;
use App\Models\Admin\MerchantAdminUser;
use App\Models\Email\SystemEmail;
use App\Models\Email\SystemEmailOfHead;
use App\Models\Email\SystemEmailOfMerchant;
use App\Models\Email\SystemEmailOfUser;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
     * SystemEmailEventListener constructor.
     *
     * @param  SystemEmail $systemEmail SystemEmail.
     * @return void
     */
    public function __construct(SystemEmail $systemEmail)
    {
        $this->systemEmail = $systemEmail;
    }

    /**
     * Handle the event.
     *
     * @param SystemEmailEvent $event Event.
     * @return void
     * @throws \Exception Exception.
     */
    public function handle(SystemEmailEvent $event): void
    {
        $systemEmail = $this->systemEmail->find($event->emailId);
        try {
            DB::beginTransaction();
            if ((int) $systemEmail->type === SystemEmail::TYPE_HEAD_TO_MER) {
                $this->_toSaveEmailOfMer($systemEmail, $event);
            }

            if ((int) $systemEmail->type === SystemEmail::TYPE_MER_TO_USER) {
                $this->_toSaveEmailOfUser($systemEmail, $event);
            }

            if ((int) $systemEmail->type === SystemEmail::TYPE_MER_TO_HEAD) {
                $this->_toSaveEmailOfHead($event);
            }
            $this->systemEmail->where('id', $event->emailId)->update(['is_send' => SystemEmail::IS_SEND_YES]);
            DB::commit();
        } catch (\Throwable $exception) {
            DB::rollBack();
            throw new \Exception('303001');
        }
    }

    /**
     * 发送到厅主.
     *
     * @param SystemEmail      $systemEmail 邮件.
     * @param SystemEmailEvent $event       事件.
     * @return void
     */
    private function _toSaveEmailOfMer(SystemEmail $systemEmail, SystemEmailEvent $event): void
    {
        $receiverIds = $systemEmail->receiver_ids;
        $receivers   = MerchantAdminUser::with('platform:id,sign')->whereIn('id', $receiverIds)->get();
        $data        = [];
        foreach ($receivers as $receiver) {
            $tmpData                  = [];
            $tmpData['email_id']      = $event->emailId;
            $tmpData['merchant_id']   = $receiver->id;
            $tmpData['platform_sign'] = $receiver->platform->sign ?? '';
            $tmpData['created_at']    = Carbon::now();
            $tmpData['updated_at']    = Carbon::now();
            $data[]                   = $tmpData;
        }
        SystemEmailOfMerchant::insert($data);
    }

    /**
     * 发送到会员.
     *
     * @param SystemEmail      $systemEmail 邮件.
     * @param SystemEmailEvent $event       事件.
     * @return void
     */
    private function _toSaveEmailOfUser(SystemEmail $systemEmail, SystemEmailEvent $event): void
    {
        $platformSign = $systemEmail->platform_sign;
        $receiverIds  = $systemEmail->receiver_ids;
        $data         = [];
        foreach ($receiverIds as $receiverId) {
            $tmpData                  = [];
            $tmpData['email_id']      = $event->emailId;
            $tmpData['user_id']       = $receiverId;
            $tmpData['platform_sign'] = $platformSign;
            $tmpData['created_at']    = Carbon::now();
            $tmpData['updated_at']    = Carbon::now();
            $data[]                   = $tmpData;
        }
        SystemEmailOfUser::insert($data);
    }

    /**
     * 发送到总控.
     *
     * @param SystemEmailEvent $event 事件.
     * @return void
     */
    private function _toSaveEmailOfHead(SystemEmailEvent $event): void
    {
        $data = [
                 'email_id'   => $event->emailId,
                 'created_at' => Carbon::now(),
                 'updated_at' => Carbon::now(),
                ];
        SystemEmailOfHead::insert($data);
    }
}
