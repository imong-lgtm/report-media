<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class ChangeImageToLongtextInArticlesTable extends Migration
{
    public function up()
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            DB::statement('ALTER TABLE articles ALTER COLUMN image TYPE TEXT');
        } else {
            // SQLite doesn't enforce column length, so no change needed
            // But for MySQL if ever used:
            DB::statement('SELECT 1'); // no-op for SQLite
        }
    }

    public function down()
    {
        // Reversing TEXT to VARCHAR is lossy; skip for safety
    }
}
