<?php

namespace App\Jobs\Email;

use App\Events\SystemEmailEvent;
use App\Models\Email\SystemEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

/**
 * Class HeadquartersSendMail
 * @package App\Jobs\Email
 */
class HeadquartersSendMail implements ShouldQueue
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
        event(new SystemEmailEvent($this->email->id));
    }
}
