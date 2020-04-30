<?php

use App\Models\Systems\StaticResource;
use Illuminate\Database\Seeder;

/**
 * Class StaticResourceSeeder
 */
class StaticResourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        StaticResource::insert(
            [
             [
              'path'        => 'backend/static_resource/json/cron_job.json',
              'type'        => null,
              'table_name'  => null,
              'static_type' => 2,
             ],
            ],
        );
    }
}
