<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            // Référencer correctement la colonne id_video de la table videos
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->references('id_video')->on('videos')->onDelete('cascade');
            $table->string('user_id')->nullable(); // ID de l'utilisateur qui a noté
            $table->integer('note')->comment('Note de 1 à 5');
            $table->timestamps();
            
            // Optionnel: s'assurer qu'un utilisateur ne peut noter une vidéo qu'une seule fois
            $table->unique(['video_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
};