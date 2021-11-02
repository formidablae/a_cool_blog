<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class Init extends Migration
{
   /**
     * Run the migrations.
     */
    public function up()
    {
        if ($this->doMigration()) {
            DB::unprepared(file_get_contents(__DIR__ . '/init/up.sql'));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        if ($this->doMigration()) {
            DB::unprepared(file_get_contents(__DIR__ . '/init/down.sql'));
        }
    }

    private function doMigration()
    {
        return App::environment(['local']);
    }
}
