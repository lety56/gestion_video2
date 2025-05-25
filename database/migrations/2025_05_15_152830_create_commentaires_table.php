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
        Schema::create('commentaires', function (Blueprint $table) {
            $table->id();
            // Correction: référencer id_video au lieu de id dans la table videos
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->references('id_video')->on('videos')->onDelete('cascade');
            $table->string('auteur')->nullable(); // ou lié à un user si connecté
            $table->text('contenu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('commentaires');
    }
};
