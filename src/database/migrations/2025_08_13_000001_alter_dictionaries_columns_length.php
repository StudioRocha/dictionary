<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 既存データを新制約に合わせてトリム
        DB::statement("UPDATE `dictionaries` SET `keyword` = LEFT(`keyword`, 10) WHERE CHAR_LENGTH(`keyword`) > 10");
        DB::statement("UPDATE `dictionaries` SET `description` = LEFT(`description`, 50) WHERE CHAR_LENGTH(`description`) > 50");

        // DBALを使わずに生SQLで変更（MySQL系想定）
        DB::statement('ALTER TABLE `dictionaries` MODIFY `keyword` VARCHAR(10) NOT NULL');
        DB::statement('ALTER TABLE `dictionaries` MODIFY `description` VARCHAR(50) NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE `dictionaries` MODIFY `keyword` VARCHAR(255) NOT NULL');
        DB::statement('ALTER TABLE `dictionaries` MODIFY `description` TEXT NOT NULL');
    }
};


