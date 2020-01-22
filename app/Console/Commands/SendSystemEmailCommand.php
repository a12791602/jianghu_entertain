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
     * Execute the console command.
     * @param SystemEmail $systemEmail SystemEmail.
     * @return boolean
     */
    public function handle(SystemEmail $systemEmail): bool
    {
        $delayEmails = SystemEmail::where('is_send', $systemEmail::IS_SEND_NO)->where(
            'is_timing',
            $systemEmail::IS_TIMING_YES,
        )->where('send_time', '<=', Carbon::now())->get();
        try {
            foreach ($delayEmails as $delayEmail) {
                event(new SystemEmailEvent($delayEmail->id));
            }
            return true;
        } catch (\Throwable $exception) {
            return false;
        }
    }
}
