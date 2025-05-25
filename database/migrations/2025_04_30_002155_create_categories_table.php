<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Vérifier si la table existe déjà avant de la créer
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id('id_categorie');  // Clé primaire personnalisée
                $table->string('nom_categorie');
                $table->text('description')->nullable();
                $table->unsignedBigInteger('parent_id')->nullable();  // Pour les sous-catégories
                $table->unsignedBigInteger('video_id')->nullable();   // Clé étrangère vers la vidéo
                $table->timestamps();
                $table->engine = 'InnoDB';
              

                // Pas de clés étrangères ici - elles seront ajoutées dans la migration séparée
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}