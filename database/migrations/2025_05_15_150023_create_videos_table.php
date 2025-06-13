<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id('id_video');  // Clé primaire personnalisée
            $table->string('titre');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('id_categorie')->nullable();
            $table->unsignedBigInteger('id_type_operations')->nullable();
            $table->unsignedBigInteger('id_pathologie')->nullable();
            $table->string('nom_patient');
            $table->string('nom_docteur');
              $table->string('nom_intervenant');
             $table->string('chemin_fichier')->nullable(); // <== AJOUT ICI
            $table->boolean('est_telechargeable');
            $table->integer('duree')->default(0);
            $table->timestamp('date_enregistrement')->useCurrent();
            $table->timestamp('date_ajout')->useCurrent();
             $table->timestamp('date_intervenant')->useCurrent();
            $table->timestamps();

            $table->engine = 'InnoDB';

            // Clés étrangères
            $table->foreign('id_categorie')->references('id_categorie')->on('categories')->onDelete('set null');
            $table->foreign('id_type_operations')->references('id_type_operations')->on('type_operations')->onDelete('set null');
            $table->foreign('id_pathologie')->references('id')->on('pathologies')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('videos');
    }
}
