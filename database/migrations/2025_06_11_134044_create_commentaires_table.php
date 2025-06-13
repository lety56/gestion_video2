<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id('id_commentaire');
            $table->text('contenu');
            $table->unsignedBigInteger('id_video');
            $table->unsignedBigInteger('id_utilisateur');
            $table->timestamps();

            // Clés étrangères
            $table->foreign('id_video')
                  ->references('id_video')
                  ->on('videos')
                  ->onDelete('cascade');

            $table->foreign('id_utilisateur')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
};