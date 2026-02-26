<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class ChangeImageToLongtextInArticlesTable extends Migration
{
    public function up()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->longText('image')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('articles', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
}
