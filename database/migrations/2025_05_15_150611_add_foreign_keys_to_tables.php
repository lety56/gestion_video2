<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToTables extends Migration
{
    public function up()
    {
        // Ajouter les clés étrangères à la table videos
        Schema::table('videos', function (Blueprint $table) {
            $table->foreign('id_categorie')->references('id_categorie')->on('categories')->onDelete('set null');
            // Corriger cette ligne pour référencer id_type_operations au lieu de id
            $table->foreign('id_type_operations')->references('id_type_operations')->on('type_operations')->onDelete('set null');
            $table->foreign('id_pathologie')->references('id')->on('pathologies')->onDelete('set null');
        });
       
        // Ajouter les clés étrangères à la table categories
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id_categorie')->on('categories')->onDelete('set null');
            $table->foreign('video_id')->references('id_video')->on('videos')->onDelete('set null');
        });
    }

    public function down()
    {
        // Supprimer les clés étrangères de la table videos
        Schema::table('videos', function (Blueprint $table) {
            $table->dropForeign(['id_categorie']);
            $table->dropForeign(['id_type_operations']);
            $table->dropForeign(['id_pathologie']);
        });
       
        // Supprimer les clés étrangères de la table categories
        Schema::table('categories', function (Blueprint $table) {
            $table->dropForeign(['parent_id']);
            $table->dropForeign(['video_id']);
        });
    }
}
