<?php

namespace App\Console\Commands;

use App\Models\User\FrontendUsersGameId;
use Illuminate\Console\Command;

/**
 * Generate Front-end user unique ID.
 * @package App\Console\Commands
 */
class GenerateUserGmaeId extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:user-game-id {brand}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate front-end user unique ID';

    /**
     * Execute the console command.
     * @param FrontendUsersGameId $usersGameId FrontendUsersGameId.
     * @return boolean
     */
    public function handle(FrontendUsersGameId $usersGameId): bool
    {
        $usersGameId->generateUserUniqueID($this->argument('brand'));
        return true;
    }
}
