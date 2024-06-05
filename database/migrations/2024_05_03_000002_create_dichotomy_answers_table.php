<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dichotomy_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('strategy_id');
            $table->json('dichotomy_ei')->nullable();
            $table->json('dichotomy_sn')->nullable();
            $table->json('dichotomy_tf')->nullable();
            $table->json('dichotomy_jp')->nullable();
            $table->json('letter_result')->nullable();
            $table->timestamps();

            $table->foreign('strategy_id')
                ->references('id')
                ->on('strategies')
                ->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('dichotomy_answers');
    }
};
