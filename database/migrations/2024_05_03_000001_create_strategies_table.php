<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('strategies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('focus')->nullable();
            $table->text('characteristics')->nullable();
            $table->text('activities')->nullable();
            $table->text('applied_resources')->nullable();
            $table->json('personalities')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');
        });
    }

    public function down()
    {
        Schema::dropIfExists('strategies');
    }
};
