<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('strategies', function (Blueprint $table) {
            $table->text('description')->after('reference')->nullable();
        });
    }

    public function down()
    {
        Schema::table('strategies', function (Blueprint $table) {
            $table->dropColumn('description');
        });
    }
};
