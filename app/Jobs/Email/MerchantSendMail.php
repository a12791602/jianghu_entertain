<?php

namespace App\Jobs\Email;

use App\Events\PlatformNoticeEvent;
use App\Events\SystemEmailEvent;
use App\JHHYLibs\JHHYCnst;
use App\Models\Email\SystemEmail;
use App\Models\Email\SystemEmailSend;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class MerchantSendMail
 * @package App\Jobs\Email
 */
class MerchantSendMail implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;
    
    /**
     * @var SystemEmail $email SystemEmail.
     */
    protected $email;

    /**
     * Create a new job instance.
     *
     * @param SystemEmail $email SystemEmail.
     * @param integer     $delay 延迟发送时间的秒数.
     */
    public function __construct(SystemEmail $email, int $delay)
    {
        $this->email = $email;
        $this->delay($delay);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        SystemEmailSend::create(
            [
             'email_id'  => $this->email->id,
             'sender_id' => $this->email->sender_id,
            ],
        );
        event(new SystemEmailEvent($this->email->id));
        broadcast(new PlatformNoticeEvent(JHHYCnst::NOTICE_OF_EMAIL, '', $this->email->toArray()));
    }
}
