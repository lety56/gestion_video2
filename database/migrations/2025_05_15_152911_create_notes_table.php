<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_video');
            $table->unsignedBigInteger('id_user')->nullable();
            $table->integer('note')->between(1, 5);
            $table->text('commentaire')->nullable();
            $table->timestamps();

            // Clés étrangères
            $table->foreign('id_video')
                  ->references('id_video')
                  ->on('videos')
                  ->onDelete('cascade');
                  
            $table->foreign('id_user')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('notes');
    }
};