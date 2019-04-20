<?php

use Illuminate\Database\Migrations\Migration;

class SetupBaseDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sqliteFile = storage_path('database/sqlite.sql');
        $fileContent = File::get($sqliteFile);

        DB::unprepared($fileContent);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $sqliteFile = storage_path('database/drop.sql');
        $fileContent = File::get($sqliteFile);

        DB::unprepared($fileContent);
    }
}
