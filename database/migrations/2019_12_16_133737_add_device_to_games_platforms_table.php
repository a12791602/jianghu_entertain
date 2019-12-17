<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddDeviceToGamesPlatformsTable
 */
class AddDeviceToGamesPlatformsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table(
            'games_platforms',
            static function (Blueprint $table): void {
                $table->tinyInteger('device')->default(0)->after('is_hot');
            },
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table(
            'games_platforms',
            static function (Blueprint $table): void {
                $table->dropColumn('device');
            },
        );
    }
}
