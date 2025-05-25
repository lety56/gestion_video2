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
        Schema::create('droits_acces', function (Blueprint $table) {
            $table->id('id_droit');
            
            // Clés étrangères
            $table->unsignedBigInteger('id_role');
            $table->foreign('id_role')->references('id_role')->on('roles')->onDelete('cascade');
            
            // On peut référencer soit une ressource générique, soit directement un ID d'objet spécifique
            $table->unsignedBigInteger('id_ressource')->nullable();
            $table->foreign('id_ressource')->references('id_ressource')->on('ressources')->onDelete('cascade');
            
            // Pour les cas où nous voulons référencer directement une instance spécifique
            $table->unsignedBigInteger('ressource_specifique_id')->nullable();
            $table->string('type_ressource'); // 'video', 'categorie', 'annotation', etc.
            
            // Permissions (stockées comme chaînes ou comme booléens)
            $table->boolean('permission_lecture')->default(false);
            $table->boolean('permission_ecriture')->default(false);
            $table->boolean('permission_modification')->default(false);
            $table->boolean('permission_suppression')->default(false);
            
            // Alternative: stocker les permissions comme une seule chaîne
            // $table->string('permission'); // 'lecture', 'ecriture', 'modification', 'suppression', ou combinaison
            
            $table->timestamps();
            
            // Contrainte d'unicité pour éviter les doublons
            $table->unique(['id_role', 'id_ressource', 'type_ressource', 'ressource_specifique_id'], 'unique_permission');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('droits_acces');
    }
};
