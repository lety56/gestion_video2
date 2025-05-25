<?php
// 1. Correction de la migration CreateTypeOperationsTable
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypeOperationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('type_operations', function (Blueprint $table) {
            // Option 1: Garder id_type_operations comme nom de la clé primaire
            $table->id('id_type_operations');
            $table->string('nom_type_operation');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('type_operations');
    }
}