<?php

namespace App\Console\Commands;

use App\Events\SystemEmailEvent;
use App\Models\Email\SystemEmail;
use Carbon\Carbon;
use Illuminate\Console\Command;

/**
 * Class SendSystemEmailCommand
 *
 * @package App\Console\Commands
 */
class SendSystemEmailCommand extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:systemEmail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     * @param SystemEmail $systemEmail SystemEmail.
     * @return void
     */
    public function handle(SystemEmail $systemEmail)
    {
        $delayEmails = SystemEmail::where('is_send', $systemEmail::IS_SEND_NO)->where(
            'is_timing',
            $systemEmail::IS_TIMING_YES,
        )->where('send_time', '<=', Carbon::now())->get();
        if (!$delayEmails->isEmpty()) {
            foreach ($delayEmails as $delayEmail) {
                event(
                    new SystemEmailEvent(
                        $delayEmail->id,
                        $delayEmail->receiver_type,
                        json_decode($delayEmail->receivers, true),
                        $delayEmail->platform_sign ?? '',
                    ),
                );
            }
        }
    }
}
